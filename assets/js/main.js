const postData = async ({ url, data }) => {
    const res = await fetch(url, {
        method: "POST",
        body: data
    });

    if (!res.ok) {
        throw new Error(`from ${url}, with status - ${res.status}`);
    }

    return await res.json();
}

const refreshPhotoLoader = () => {
    const photoLoader = document.querySelector('.add-list__item.add-list__item--active');
    const addList = document.querySelector('.add-list');
    const addButton = addList.querySelector('.add-list__item--add');
    const addInput = addList.querySelector('#product-photo');

    if (photoLoader) {
        photoLoader.classList.remove('add-list__item--active')
        addList.removeChild(photoLoader);
        addInput.value = '';
        checkList(addList, addButton);
    }
}

///////////////////////////////////////////////////////////////////////



const form = document.querySelector('#add-product-form');
const popupEnd = document.querySelector('.page-add__popup-end');
const popupBtn = document.querySelector('.popup_btn');

if (form) {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // If errors already exist - remove them
        const errors = document.querySelectorAll('.form_error');
        if (errors.length) {
            errors.forEach(elem => {
                elem.remove();
            });
        }

        // Make Post Request
        const url = '/product/add'
        const data = new FormData(e.target);

        const res = await postData({ url, data })

        console.log(res);
        // Check result status
        if (Object.keys(res.errors).length === 0) {
            // If ok ↓  
            form.reset();
            form.hidden = true;
            popupEnd.hidden = false;

            refreshPhotoLoader();

        } else {
            // If some errors ↓


            for (const key in res.errors) {
                const error = document.createElement('div');
                error.classList.add('form_error');
                error.innerText = res.errors[key];
                form.appendChild(error);
            }

        }

    })

    // Hide popup
    popupBtn.addEventListener('click', (e) => {
        e.preventDefault()
        form.hidden = false;
        popupEnd.hidden = true;
    })
}


///////////////////////////////////////////////////////////////////////


const filterForm = document.querySelector('#product-filter-form');



if (filterForm) {

    filterForm.addEventListener('submit', async (e) => {
        // e.preventDefault();

        // const formData = new FormData(e.target);

        // const url = '/catalog?jfaf=wrjwjrjioworijiowr'

        // const formProps = Object.fromEntries(formData);
        // console.log(formProps);

        // fetch(url);
        // fetch(url, {
        //     body: formData,
        // }).then(res => res.json()).then(res => console.log(res))
        // const res = await postData({ url, data: formData })


    })

}

// Sorting View
const sortFilter = document.querySelector('#sort-filter');

if (sortFilter) {
    sortFilter.addEventListener('change', (e) => {

        let search = window.location.search.replace(/&*page=\d/g, '')
        let url = document.location.pathname + (search ? (search + '&') : (search + '?')) + e.target.name + '=' + e.target.value;
        window.location = url
    })
}

////////////////////////////////////////////////////////////////////////



if (document.querySelector('.shop-page')) {

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


////////////////////////////////////////////////////////////////////////


const paginatorItems = document.querySelectorAll('.paginator__item');

if (paginatorItems.length) {

    paginatorItems.forEach(paginatorItem => {

        paginatorItem.addEventListener('click', (e) => {
            const target = e.target;
            const linkedPage = target.getAttribute('data-page');
            console.log(linkedPage);
        })

    });
}

////////////////////////////////////////////////////////////////////////



const shopItems = document.querySelectorAll('.shop__item');
const cartIcon = document.querySelector('.page-header__cart-icon');


if (shopItems.length) {
    const shopOrder = document.querySelector('.shop-page__popup-end');
    const closeBtn = shopOrder.querySelector('button');


    shopItems.forEach(shopItem => {
        shopItem.addEventListener('click', async (e) => {


            const id = shopItem.getAttribute('data-id')
            const url = '/cart/add'
            const data = new FormData()
            data.append('id', id)

            const res = await postData({ url, data })

            if (res.errors.length) {
                res.errors.forEach(error => {
                    alert(error)
                });

                throw new Error(`from ${url}, with status`);
            }

            cartIcon.textContent++;



            // For popup
            toggleHidden(document.querySelector('.intro'), document.querySelector('.shop'), shopOrder);
            const btnCloseFunc = (e) => {
                toggleHidden(document.querySelector('.intro'), document.querySelector('.shop'), shopOrder);
                e.target.removeEventListener('click', btnCloseFunc)
            }
            closeBtn.addEventListener('click', btnCloseFunc)

        })
    });
}




//////////////////////////////////////////////////////////////////////


const removeCartBtns = document.querySelectorAll('.item-card__remove');

if (removeCartBtns.length) {
    removeCartBtns.forEach(removeCartBtn => {
        removeCartBtn.addEventListener('click', async (e) => {
            const id = removeCartBtn.getAttribute('data-id')
            const url = '/cart/remove'
            const data = new FormData()
            data.append('id', id)

            const res = await postData({ url, data })

            if (res.errors.length) {
                res.errors.forEach(error => {
                    alert(error)
                });

                throw new Error(`from ${url}, with status`);
            }

            location.reload();
        })
    });
}




//////////////////////////////////////////////////////////////////////


const orderForm = document.querySelector('.js-order');
const orderFormPage = document.querySelector('.shop-page__order');
const successPage = document.querySelector('.shop-page__popup-end');

if (orderForm) {
    
    orderForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // If errors already exist - remove them
        const errors = document.querySelectorAll('.form_error');
        if (errors.length) {
            errors.forEach(elem => {
                elem.remove();
            });
        }

        // Make Post Request
        const url = '/cart/checkout'
        const data = new FormData(e.target);

        const res = await postData({ url, data })

        if (Object.keys(res.errors).length === 0) {
            toggleHidden(successPage, orderFormPage);
            cartIcon.textContent = 0;
            orderForm.reset();

        } else {

            for (const key in res.errors) {
                const error = document.createElement('div');
                error.classList.add('form_error');
                error.innerText = res.errors[key];
                orderForm.appendChild(error);
            }

        }
        

    })
}




//////////////////////////////////////////////////////////////////////


const loginForm = document.querySelector('#login-form');
const registerForm = document.querySelector('#register-form');

if (loginForm) {
    
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // If errors already exist - remove them
        const errors = document.querySelectorAll('.form_error');
        if (errors.length) {
            errors.forEach(elem => {
                elem.remove();
            });
        }

        // Make Post Request
        const url = '/login'
        const data = new FormData(e.target);

        const res = await postData({ url, data })

        if (Object.keys(res.errors).length) {
            for (const key in res.errors) {
                const error = document.createElement('div');
                error.classList.add('form_error');
                error.innerText = res.errors[key];
                loginForm.appendChild(error);
            }
        } else {
            window.location.replace('/catalog');
        }

    })
}




//////////////////////////////////////////////////////////////////////






const cartSection = document.querySelector('.cart');
const cartBtn = document.querySelector('.cart__btn');
const pageOrder = document.querySelector('.shop-page__order');

if (cartBtn) {
    cartBtn.addEventListener('click', (e) => {
        toggleHidden(pageOrder, cartSection);
    })
}