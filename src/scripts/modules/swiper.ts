import Swiper from 'swiper';
import { Autoplay, FreeMode, Navigation, Pagination, Thumbs } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/thumbs';

export function initSwipers(): void {
	const paginateSwipers = document.querySelectorAll<HTMLElement>('.swiper.-paginate');
	paginateSwipers.forEach((container) => {
		const paginationEl = container.querySelector<HTMLElement>('.swiper-pagination');
		const nextEl = container.querySelector<HTMLElement>('.swiper-button-next');
		const prevEl = container.querySelector<HTMLElement>('.swiper-button-prev');

		const modules = [Navigation, Autoplay];
		const pagination =
			paginationEl
				? {
						el: paginationEl,
						clickable: true
					}
				: undefined;

		if (pagination) {
			modules.push(Pagination);
		}

		new Swiper(container, {
			modules,
			slidesPerView: 1,
			speed: 700,
			spaceBetween: 20,
			autoplay: {
				delay: 5000
			},
			pagination,
			navigation:
				nextEl && prevEl
					? {
							nextEl,
							prevEl
						}
					: undefined,
			breakpoints: {
				480: {
					slidesPerView: 'auto'
				}
			}
		});

		if (paginationEl) {
			paginationEl.addEventListener('mouseover', (event) => {
				const bullet = (event.target as Element | null)?.closest('.swiper-pagination-bullet');
				if (bullet instanceof HTMLElement) {
					bullet.click();
				}
			});
		}
	});

	const gear = document.querySelector<HTMLElement>('.swiper.gear');
	if (gear) {
		const paginationEl = gear.querySelector<HTMLElement>('.swiper-pagination');
		const nextEl = gear.querySelector<HTMLElement>('.swiper-button-next');
		const prevEl = gear.querySelector<HTMLElement>('.swiper-button-prev');

		const modules = [Navigation];
		const pagination =
			paginationEl
				? {
						el: paginationEl,
						clickable: true
					}
				: undefined;

		if (pagination) {
			modules.push(Pagination);
		}

		new Swiper(gear, {
			modules,
			slidesPerView: 2,
			speed: 700,
			spaceBetween: 20,
			pagination,
			navigation:
				nextEl && prevEl
					? {
							nextEl,
							prevEl
						}
					: undefined,
			breakpoints: {
				768: {
					slidesPerView: 4
				}
			}
		});
	}

	const posts = document.querySelector<HTMLElement>('.swiper.posts');
	if (posts) {
		const nextEl = posts.querySelector<HTMLElement>('.swiper-button-next');
		const prevEl = posts.querySelector<HTMLElement>('.swiper-button-prev');

		new Swiper(posts, {
			modules: [Navigation],
			slidesPerView: 3,
			spaceBetween: 30,
			navigation:
				nextEl && prevEl
					? {
							nextEl,
							prevEl
						}
					: undefined,
			breakpoints: {
				320: {
					centeredSlides: true,
					slidesPerView: 1,
					spaceBetween: 10
				},
				480: {
					slidesPerView: 2,
					spaceBetween: 20
				},
				1025: {
					slidesPerView: 3,
					spaceBetween: 30
				}
			}
		});
	}

	const thumbsEl = document.querySelector<HTMLElement>('.swiper.slider-thumbnail');
	const sliderEl = document.querySelector<HTMLElement>('.swiper.slider');
	if (thumbsEl && sliderEl) {
		const thumbsNextEl = thumbsEl.querySelector<HTMLElement>('.swiper-button-next');
		const thumbsPrevEl = thumbsEl.querySelector<HTMLElement>('.swiper-button-prev');
		const sliderNextEl = sliderEl.querySelector<HTMLElement>('.swiper-button-next');
		const sliderPrevEl = sliderEl.querySelector<HTMLElement>('.swiper-button-prev');

		const thumbs = new Swiper(thumbsEl, {
			modules: [FreeMode, Navigation, Thumbs],
			slidesPerView: 5,
			spaceBetween: 15,
			freeMode: true,
			loop: true,
			watchSlidesProgress: true,
			navigation:
				thumbsNextEl && thumbsPrevEl
					? {
							nextEl: thumbsNextEl,
							prevEl: thumbsPrevEl
						}
					: undefined
		});

		new Swiper(sliderEl, {
			modules: [Navigation, Thumbs],
			loop: true,
			navigation:
				sliderNextEl && sliderPrevEl
					? {
							nextEl: sliderNextEl,
							prevEl: sliderPrevEl
						}
					: undefined,
			thumbs: {
				swiper: thumbs
			}
		});
	}
}
