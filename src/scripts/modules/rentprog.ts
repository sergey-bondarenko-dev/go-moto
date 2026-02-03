type RentprogState = 'loading' | 'loaded' | 'error';

const CSS_URL = 'https://rentprog-b5205.web.app/css/app.css';
const JS_URL = 'https://rentprog-b5205.web.app/js/app.js';

const getContainers = () =>
	Array.from(
		document.querySelectorAll<HTMLElement>('[data-rentprog-container]')
	);

const setState = (containers: HTMLElement[], state: RentprogState) => {
	containers.forEach((container) => {
		container.classList.toggle('is-loading', state === 'loading');
		container.classList.toggle('is-loaded', state === 'loaded');
		container.classList.toggle('is-error', state === 'error');
		container.setAttribute('aria-busy', state === 'loading' ? 'true' : 'false');

		const text = container.querySelector<HTMLElement>('.rentprog-loader__text');
		if (text && state === 'error') {
			text.textContent = 'Не удалось загрузить форму. Обновите страницу.';
		}
	});
};

const ensureStyles = () =>
	new Promise<void>((resolve, reject) => {
		if (document.querySelector(`link[href="${CSS_URL}"]`)) {
			resolve();
			return;
		}

		const link = document.createElement('link');
		link.rel = 'stylesheet';
		link.href = CSS_URL;
		link.onload = () => resolve();
		link.onerror = () => reject();
		document.head.appendChild(link);
	});

const ensureScript = () =>
	new Promise<void>((resolve, reject) => {
		if (document.querySelector(`script[src="${JS_URL}"]`)) {
			resolve();
			return;
		}

		const script = document.createElement('script');
		script.src = JS_URL;
		script.async = true;
		script.onload = () => resolve();
		script.onerror = () => reject();
		document.body.appendChild(script);
	});

const loadRentprog = (containers: HTMLElement[]) => {
	const win = window as Window & {
		__rentprogLoadingPromise?: Promise<void>;
	};

	if (win.__rentprogLoadingPromise) {
		return win.__rentprogLoadingPromise;
	}

	setState(containers, 'loading');

	win.__rentprogLoadingPromise = Promise.all([ensureStyles(), ensureScript()])
		.then(() => {
			setState(containers, 'loaded');
		})
		.catch(() => {
			setState(containers, 'error');
		});

	return win.__rentprogLoadingPromise;
};

export const initRentprogWidget = () => {
	const containers = getContainers();
	if (!containers.length) {
		return;
	}

	if (!('IntersectionObserver' in window)) {
		loadRentprog(containers);
		return;
	}

	const observer = new IntersectionObserver(
		(entries) => {
			const shouldLoad = entries.some(
				(entry) => entry.isIntersecting || entry.intersectionRatio > 0
			);
			if (shouldLoad) {
				loadRentprog(containers);
				observer.disconnect();
			}
		},
		{ rootMargin: '400px 0px', threshold: 0.01 }
	);

	containers.forEach((container) => observer.observe(container));
};
