import '../styles/main.scss';
import 'swiper/css';
import { initMobileMenu } from './modules/menu';
import { initScrollTop } from './modules/scroll-top';
import { initRentprogWidget } from './modules/rentprog';

document.querySelectorAll<HTMLSelectElement>('[data-nav-tabs-select]').forEach((selectElement) => {
	selectElement.addEventListener('change', () => {
		if (selectElement.value) {
			window.location.href = selectElement.value;
		}
	});
});

if (document.querySelector('[data-product-category-nav]')) {
	import('./modules/product-category-filter').then(({ ProductCategoryFilter }) => {
		ProductCategoryFilter.init();
	});
}

if (document.querySelector('[data-fancybox]')) {
	import('./modules/fancybox').then(({ initFancybox }) => {
		initFancybox();
	});
}

if (document.querySelector('.swiper')) {
	import('./modules/swiper').then(({ initSwipers }) => {
		initSwipers();
	});
}

if (document.querySelector('input[type="tel"]')) {
	import('./modules/forms').then(({ initForms }) => {
		initForms();
	});
}

if (document.querySelector('.counter-number')) {
	import('./modules/counter').then(({ initCounters }) => {
		initCounters();
	});
}

initMobileMenu();
initScrollTop();

const runOnReady = (fn: () => void) => {
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', fn, { once: true });
		return;
	}
	fn();
};

runOnReady(() => {
	initRentprogWidget();
});
