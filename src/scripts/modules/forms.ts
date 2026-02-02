import Inputmask from 'inputmask';

function toggleSubmitState(input: HTMLInputElement) {
	const form = input.closest('form');
	if (!form) {
		return;
	}

	const unmasked = input.inputmask ? input.inputmask.unmaskedvalue() : input.value;
	if (unmasked.length < 12) {
		form.classList.add('no-submit');
	} else {
		form.classList.remove('no-submit');
	}
}

export function initForms(): void {
	const telInputs = Array.from(document.querySelectorAll<HTMLInputElement>('input[type="tel"]'));
	if (telInputs.length) {
		const mask = new Inputmask({
			mask: '+375 (999) 999-99-99',
			showMaskOnHover: false,
			showMaskOnFocus: true,
			onincomplete: (_event, _buffer, _c, input) => {
				if (input instanceof HTMLInputElement) {
					toggleSubmitState(input);
				}
			},
			oncomplete: (_event, input) => {
				if (input instanceof HTMLInputElement) {
					toggleSubmitState(input);
				}
			}
		});

		telInputs.forEach((input) => {
			mask.mask(input);
			input.addEventListener('input', () => toggleSubmitState(input));
			input.addEventListener('blur', () => toggleSubmitState(input));
			input.addEventListener('focus', () => toggleSubmitState(input));
			input.addEventListener('keydown', () => toggleSubmitState(input));
		});
	}

	document.querySelectorAll<HTMLFormElement>('form').forEach((form) => {
		form.addEventListener('submit', (event) => {
			if (form.classList.contains('no-submit')) {
				event.preventDefault();
				alert('Поле Телефон не заполнено!');
				event.stopImmediatePropagation();
			}
		});
	});
}
