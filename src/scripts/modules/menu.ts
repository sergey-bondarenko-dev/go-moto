export function initMobileMenu(): void {
	const mobileMenu = document.querySelector('.mobile-menu');
	const html = document.documentElement;

	if (!mobileMenu || !html) {
		return;
	}

	document.querySelectorAll('.site-burger').forEach((el) => {
		el.addEventListener('click', () => {
			mobileMenu.classList.toggle('is-open');
			html.classList.toggle('no-scroll');
		});
	});
}
