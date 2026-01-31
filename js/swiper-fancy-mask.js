window.addEventListener("DOMContentLoaded", function () {
	[].forEach.call(document.querySelectorAll('input[type="tel"]'), function (input) {
		var keyCode;
		function mask(event) {
			event.keyCode && (keyCode = event.keyCode);
			var pos = this.selectionStart;
			if (pos < 3) event.preventDefault();
			var matrix = "+375 (___) ___-__-__",
				i = 0,
				def = matrix.replace(/\D/g, ""),
				val = this.value.replace(/\D/g, ""),
				new_value = matrix.replace(/[_\d]/g, function (a) {
					return i < val.length ? val.charAt(i++) || def.charAt(i) : a
				});
			i = new_value.indexOf("_");
			if (i != -1) {
				i < 5 && (i = 3);
				new_value = new_value.slice(0, i)
			}
			var reg = matrix.substr(0, this.value.length).replace(/_+/g,
				function (a) {
					return "\\d{1," + a.length + "}"
				}).replace(/[+()]/g, "\\$&");
			reg = new RegExp("^" + reg + "$");
			if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
			if (event.type == "blur" && this.value.length < 5) this.value = ""

			if (this.value.length < 18) {
				this.closest("form").classList.add("no-submit");
			} else {
				this.closest("form").classList.remove("no-submit");
			}
		}

		input.addEventListener("input", mask, false);
		input.addEventListener("focus", mask, false);
		input.addEventListener("blur", mask, false);
		input.addEventListener("keydown", mask, false)

	});

	[].forEach.call(document.querySelectorAll('form'), function (form) {
		form.addEventListener("submit", function (e) {
			if (this.classList.contains('no-submit')) {
				e.preventDefault();
				alert('Поле Телефон не заполнено!');
				e.stopImmediatePropagation();
				return false;
			}
		});
	});







	/*
	
	
	
	
	var loadedAos = false,
		timerAos;
	let themeUrl = mlineObj.themeUrl;
	window.addEventListener('scroll', loadAos, { passive: true });
	window.addEventListener('touchstart', loadAos);
	document.addEventListener('mouseenter', loadAos);
	document.addEventListener('click', loadAos);
	document.addEventListener('DOMContentLoaded', loadAosFallback);
	
	function loadAosFallback() {
		timerAos = setTimeout(loadAos, 6000);
	}

	function loadAos() {
		if (loadedAos) return;

		let linkAos = document.createElement('link'),
			scriptAos = document.createElement('script');
		linkAos.href = themeUrl + "/css/aos.css";
		linkAos.rel = "stylesheet";
		scriptAos.src = themeUrl + "/js/aos.js";
	
		document.head.insertBefore(linkAos, document.querySelector('title'));
		document.body.append(scriptAos);

		scriptAos.onload = function () {
			let backdropClick = "close";
			if (window.innerWidth <= 767) {
				backdropClick = false;
			} 
		};
		
		loadedAos = true;

		clearTimeout(timerAos);

		window.removeEventListener('scroll', loadAos);
		window.removeEventListener('touchstart', loadAos);
		document.removeEventListener('mouseenter', loadAos);
		document.removeEventListener('click', loadAos);
		document.removeEventListener('DOMContentLoaded', loadAosFallback);
	}
*/



});

const mobileMenu = document.querySelector('.mobile-menu');
const overlay = document.querySelector('.overlay');
const html = document.querySelector('html');

document.querySelectorAll('.site-burger').forEach(function (el) {
	el.addEventListener('click', function () {
		mobileMenu?.classList.toggle('is-open');
		overlay?.classList.toggle('is-open');
		html.classList.toggle('no-scroll');
	});
});

// Fancybox.bind("[data-fancybox]", {
// });

let backdropClick = "close";
if (window.innerWidth <= 767) {
	backdropClick = false;
}

Fancybox.bind("[data-fancybox]", {
	autoFocus: false,
	backdropClick: backdropClick,
	contentClick: false,
	dragToClose: true,
	hideScrollbar: false
});

const swipersPaginate = document.querySelectorAll('.swiper.-paginate');

if (swipersPaginate.length) {

	swipersPaginate.forEach((s) => {
		let pagination = s.querySelector(".swiper-pagination");

		new Swiper(s, {
			slidesPerView: 1,
			speed: 700,
			spaceBetween: 20,
			autoplay: {
				enabled: true,
				delay: 5000,
			},
			pagination: {
				el: pagination,
				clickable: true
			},
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},

			breakpoints: {
				'480': {
					slidesPerView: "auto",
				},
			},
		});
	});



	document.querySelectorAll('.swiper-pagination-bullet').forEach(el => el.addEventListener('mouseover', (event) => {
		el.click();
	}));
}

const swiperGear = document.querySelector('.gear');

if (swiperGear) {
	new Swiper(swiperGear, {
		slidesPerView: 2,
		speed: 700,
		spaceBetween: 20,
		// autoplay: {
		// 	enabled: true,
		// 	delay: 5000,
		// },
		pagination: {
			el: swiperGear.querySelector(".swiper-pagination"),
			clickable: true
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		breakpoints: {
			'768': {
				slidesPerView: "4",
			},
		},
	});
};

const swiperScrollbar = document.querySelectorAll('.slider-box.-scrollbar');
if (swiperScrollbar.length) {

	let autoplay;

	let swipers = document.querySelectorAll('.slider-box.-scrollbar > .swiper');

	swipers.forEach((swiper, index) => {
		swiper.classList.add(`scrollbar-swiper-${index}`);
	});

	swiperScrollbar.forEach((container, index) => {
		container.querySelector('.swiper-button-next').classList.add(`scrollbar-swiper-next-${index}`);
		container.querySelector('.swiper-button-prev').classList.add(`scrollbar-swiper-prev-${index}`);
		container.querySelector('.swiper-scrollbar').classList.add(`swiper-scrollbar-${index}`);
	});

	swipers.forEach((swiper, index) => {
		if (swiper.classList.contains('-autoplay')) {
			autoplay = {
				delay: 5000
			};
		} else {
			autoplay = false;
		}
		new Swiper(`.scrollbar-swiper-${index}`, {
			slidesPerView: "auto",
			speed: 700,
			grabCursor: true,
			autoplay: autoplay,
			navigation: {
				nextEl: `.scrollbar-swiper-next-${index}`,
				prevEl: `.scrollbar-swiper-prev-${index}`,
			},
			scrollbar: {
				el: `.swiper-scrollbar-${index}`,
				draggable: true,
			},
		});
	});

}

const swiperOnlyNav = document.querySelectorAll('.swiper.-onlynav');
if (swiperOnlyNav.length) {

	let autoplay;

	let swipers = document.querySelectorAll('.swiper.-onlynav');

	swipers.forEach((swiper, index) => {
		swiper.classList.add(`onlynav-swiper-${index}`);
	});

	swipers.forEach((swiper, index) => {
		if (swiper.classList.contains('-autoplay')) {
			autoplay = {
				delay: 5000
			};
		} else {
			autoplay = false;
		}
		new Swiper(`.onlynav-swiper-${index}`, {
			speed: 700,
			grabCursor: true,
			autoplay: autoplay,
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			on: {
				slideChange: (s) => {
					let container = swiper.previousElementSibling;
					let points = container.querySelectorAll('.prices-steps__point');
					points.forEach((point, index) => {
						if (point.classList.contains('-is-active') && index !== s.realIndex) {
							point.classList.remove('-is-active');
						}
						if (index === s.realIndex) {
							point.classList.add('-is-active');
						}
					});
				},
			}
		});
	});

}

const posts = new Swiper('.posts', {
	slidesPerView: 3,
	spaceBetween: 30,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	breakpoints: {
		'320': {
			centeredSlides: true,
			slidesPerView: 1,
			spaceBetween: 10,
		},
		'480': {
			slidesPerView: 2,
			spaceBetween: 20,
		},
		'1025': {
			slidesPerView: 3,
			spaceBetween: 30,
		},
	}
});

const sliderThumbnail = new Swiper('.slider-thumbnail', {
	slidesPerView: 5,
	spaceBetween: 15,
	freeMode: true,
	loop: true,
	watchSlidesVisibility: true,
	watchSlidesProgress: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
});

const slider = new Swiper('.slider', {
	loop: true,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
	thumbs: {
		swiper: sliderThumbnail
	}
});

