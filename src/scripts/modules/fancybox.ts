import { Fancybox } from '@fancyapps/ui';
import '@fancyapps/ui/dist/fancybox/fancybox.css';

export function initFancybox(): void {
	const backdropClick = window.innerWidth <= 767 ? false : 'close';
	Fancybox.bind('[data-fancybox]', {
		backdropClick,
		hideScrollbar: false
	});
}

initFancybox();
