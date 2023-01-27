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









// jquery range maxmin
if (document.querySelector('.shop-page')) {

    const min = $('.min-price').data('start');
    const max = $('.max-price').data('start');


    $('.range__line').slider({
        min,
        max,
        values: [min, max],
        range: true,
        slide: setRangeValues
    });
}


function setRangeValues(event, ui) {
    let minValue = ui.values[0];
    let maxValue = ui.values[1];

    $('.min-price').text(minValue + ' $');
    $('.max-price').text(maxValue + ' $');

    $('#rng-min').val(minValue);
    $('#rng-max').val(maxValue);
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


