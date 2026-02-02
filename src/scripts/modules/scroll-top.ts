export function initScrollTop(): void {
	const wrap = document.querySelector<HTMLElement>('[data-scroll-top]');
	if (!wrap) {
		return;
	}

	const button = wrap.querySelector<HTMLButtonElement>('.scroll-top__btn');
	const path = wrap.querySelector<SVGPathElement>('.scroll-top__path');
	if (!button || !path) {
		return;
	}

	const pathLength = path.getTotalLength();
	path.style.strokeDasharray = `${pathLength} ${pathLength}`;
	path.style.strokeDashoffset = `${pathLength}`;
	path.getBoundingClientRect();

	wrap.classList.remove('is-visible');

	const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	const threshold = 200;
	let ticking = false;

	const update = () => {
		const scroll = window.scrollY || document.documentElement.scrollTop;
		const height = document.documentElement.scrollHeight - window.innerHeight;
		const progress = height > 0 ? pathLength - (scroll / height) * pathLength : pathLength;

		path.style.strokeDashoffset = `${progress}`;
		if (height > 0 && scroll > threshold) {
			wrap.classList.add('is-visible');
		} else {
			wrap.classList.remove('is-visible');
		}
	};

	const onScroll = () => {
		if (ticking) {
			return;
		}
		ticking = true;
		requestAnimationFrame(() => {
			update();
			ticking = false;
		});
	};

	window.addEventListener('scroll', onScroll, { passive: true });
	window.addEventListener('resize', onScroll);
	update();

	button.addEventListener('click', () => {
		window.scrollTo({
			top: 0,
			behavior: prefersReducedMotion ? 'auto' : 'smooth',
		});
	});
}
