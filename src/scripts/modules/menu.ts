export function initMobileMenu(): void {
	const mobileMenu = document.querySelector('.mobile-menu');
	const overlay = document.querySelector('.overlay');
	const html = document.querySelector('html');

	if (!mobileMenu || !overlay || !html) {
		return;
	}

	document.querySelectorAll('.site-burger').forEach((el) => {
		el.addEventListener('click', () => {
			mobileMenu.classList.toggle('is-open');
			overlay.classList.toggle('is-open');
			html.classList.toggle('no-scroll');
		});
	});
}
