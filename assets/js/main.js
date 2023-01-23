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
        const errors = document.querySelector('.form_errors');
        if (errors) errors.remove()

        // Make Post Request
        const url = '/product/add'
        const data = new FormData(e.target);

        const res = await postData({ url, data })

        console.log(res);
        // Check result status
        if (res[1].errors.length === 0) {
            // If ok ↓  
            form.reset();
            form.hidden = true;
            popupEnd.hidden = false;

            refreshPhotoLoader();

        } else {
            // If some errors ↓
            const errors = document.createElement('div');
            errors.classList.add('form_errors');

            res.errors.forEach(error => {
                errors.innerText += error;
            });

            form.appendChild(errors);
        }

    })

    // Hide popup
    popupBtn.addEventListener('click', (e) => {
        e.preventDefault()
        form.hidden = false;
        popupEnd.hidden = true;
    })
}

