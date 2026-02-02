function parseNumber(value: string): { num: number; decimals: number } {
	const normalized = value.replace(/\s+/g, '').replace(',', '.');
	const num = Number.parseFloat(normalized);
	if (Number.isNaN(num)) {
		return { num: 0, decimals: 0 };
	}
	const parts = normalized.split('.');
	const decimals = parts[1] ? parts[1].length : 0;
	return { num, decimals };
}

function formatNumber(value: number, decimals: number): string {
	if (decimals <= 0) {
		return Math.round(value).toString();
	}
	return value.toFixed(decimals);
}

function animateCounter(el: HTMLElement, target: number, decimals: number, duration: number): void {
	const start = performance.now();
	const from = 0;

	const tick = (now: number) => {
		const progress = Math.min((now - start) / duration, 1);
		const eased = 1 - Math.pow(1 - progress, 3);
		const current = from + (target - from) * eased;
		el.textContent = formatNumber(current, decimals);

		if (progress < 1) {
			requestAnimationFrame(tick);
		} else {
			el.textContent = formatNumber(target, decimals);
		}
	};

	requestAnimationFrame(tick);
}

export function initCounters(): void {
	const items = Array.from(document.querySelectorAll<HTMLElement>('.counter-number'));
	if (!items.length) {
		return;
	}

	const duration = 2000;
	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				if (!entry.isIntersecting) {
					return;
				}

				const el = entry.target as HTMLElement;
				if (el.dataset.counterStarted === '1') {
					return;
				}

				const raw = el.dataset.number ?? el.textContent ?? '0';
				const { num, decimals } = parseNumber(raw);
				el.dataset.counterStarted = '1';
				animateCounter(el, num, decimals, duration);
				observer.unobserve(el);
			});
		},
		{ threshold: 0.2 }
	);

	items.forEach((el) => observer.observe(el));
}
