import '../styles/main.scss';
import { initMobileMenu } from './modules/menu';
import { initScrollTop } from './modules/scroll-top';

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

if (document.querySelector('form') || document.querySelector('input[type="tel"]')) {
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
