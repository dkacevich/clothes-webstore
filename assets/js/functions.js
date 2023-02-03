




let iconMenu = document.querySelector(".icon-menu");
if (iconMenu) {
    iconMenu.addEventListener("click", function (e) {
        if (bodyLockStatus) {
            bodyLockToggle();
            document.documentElement.classList.toggle("menu-open");
        }
    });
};



// =============================================================================



let bodyLockStatus = true;
let bodyLockToggle = (delay = 500) => {
	if (document.documentElement.classList.contains('lock')) {
		bodyUnlock(delay);
	} else {
		bodyLock(delay);
	}
}

let bodyUnlock = (delay = 500) => {
	let body = document.querySelector("body");
	if (bodyLockStatus) {
		let lock_padding = document.querySelectorAll("[data-lp]");
		setTimeout(() => {
			for (let index = 0; index < lock_padding.length; index++) {
				const el = lock_padding[index];
				el.style.paddingRight = '0px';
			}
			body.style.paddingRight = '0px';
			document.documentElement.classList.remove("lock");
		}, delay);
		bodyLockStatus = false;
		setTimeout(function () {
			bodyLockStatus = true;
		}, delay);
	}
}
let bodyLock = (delay = 500) => {
	let body = document.querySelector("body");
	if (bodyLockStatus) {
		let lock_padding = document.querySelectorAll("[data-lp]");
		for (let index = 0; index < lock_padding.length; index++) {
			const el = lock_padding[index];
			el.style.paddingRight = window.innerWidth - document.querySelector('.wrapper').offsetWidth + 'px';
		}
		body.style.paddingRight = window.innerWidth - document.querySelector('.wrapper').offsetWidth + 'px';
		document.documentElement.classList.add("lock");

		bodyLockStatus = false;
		setTimeout(function () {
			bodyLockStatus = true;
		}, delay);
	}
}





if (document.querySelector('.catalog')) {

    const handlesSlider = document.querySelector('.range__line');
    const minPrice = document.querySelector('.min-price');
    const maxPrice = document.querySelector('.max-price');

    const formMinPrice = document.querySelector('#rng-min');
    const formMaxPrice = document.querySelector('#rng-max');


    let minDefault = parseInt(minPrice.getAttribute('data-start'));
    let maxDefault = parseInt(maxPrice.getAttribute('data-start'));

    let minCurrent = parseInt(minPrice.getAttribute('data-value'));
    let maxCurrent = parseInt(maxPrice.getAttribute('data-value'));


    noUiSlider.create(handlesSlider, {
        start: [minCurrent, maxCurrent],
        step: 1,
        range: {
            'min': [minDefault],
            'max': [maxDefault]
        }
    });

    handlesSlider.noUiSlider.on("update", (values) => {
        let min = parseInt(values[0]);
        let max = parseInt(values[1]);

        formMinPrice.setAttribute('value', values[0])
        formMaxPrice.setAttribute('value', values[1])

        minPrice.textContent = min + '$';
        maxPrice.textContent = max + '$';
    })


}
