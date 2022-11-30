import Methods from "../methods";
import {fetchPost} from "./fetch";

const body = $('body');

const getObj = (e, attrName) => {
    return e.target.closest('[' + attrName + ']') ? e.target.closest('[' + attrName + ']') : e.target;
}

const getMethodName = (e, attrName) => {
    const obj = getObj(e, attrName);
    return obj?.getAttribute(attrName)
}

const getParams = (e, attrName) => {
    const obj = getObj(e, attrName);
    const params = obj.getAttribute('data-params') ? JSON.parse(obj.getAttribute('data-params')) : {};
    if (typeof params === 'object') return params;
    return {};
}

const hasMethod = (methodName) => {
    return typeof Methods[methodName] === 'function';
}

const infiniteScroll = (callback) => {
    window.addEventListener('scroll', () => {
        const {
            scrollTop,
            scrollHeight,
            clientHeight
        } = document.documentElement;
        if (scrollTop + clientHeight >= scrollHeight - 5) {
            callback();
        }
    });
}

const formFieldError = (formFields, obj, error = false) => {
    obj.find('.form-error').remove();
    obj.find('.form-group--error').removeClass('form-group--error');
    Object.keys(formFields).forEach(i => {
        const input = obj.find('[name="' + i + '"]');
        const inputParent = input.closest('.form-group');
        if (inputParent) {
            if (formFields[i] && error) {
                if (!inputParent.find('.form-error').length) {
                    inputParent.addClass('form-group--error');
                    $(inputParent).append('<p class="form-error">' + formFields[i] + '</p>');
                }
            }
        }
    })
}

const formFieldReset = (obj) => {
    const fields = $(obj).serializeArray();
    Array.from(fields).forEach(i => {
        const field = obj.find('[name="' + i.name + '"]');
        if (field) {
            const type = field.attr('type');
            if (type !== 'hidden') {
                if (type === 'checkbox' || type === 'radio') field.prop('checked', false);
                else field.val('');
            }
        }
    })
}

const DataAttribute = {
    data: {
        default_photo: '/uploads/photos/setting/default_photo.webp',
        loading: `
        <svg class="svgLoading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="background: rgba(255, 255, 255, 0); display: block; shape-rendering: auto;" width="25px" height="25px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
            <circle cx="50" cy="50" r="30" stroke-width="4" stroke="#ffffff" stroke-dasharray="47.12388980384689 47.12388980384689" fill="none" stroke-linecap="round">
              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="0.5555555555555556s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
            </circle>
        </svg>
    `,
        plusIcon: `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus button__icon">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
    `,
        photos: []
    },
    /*
    * Click
    * */
    click() {
        const attrName = 'data-click';
        body.on('click', `[${attrName}]`, function (e) {
            e.preventDefault();
            const methodName = getMethodName(e, attrName);
            const params = getParams(e, attrName);
            if (hasMethod(methodName)) {
                Methods[methodName]({...params, obj: getObj(e, attrName)}, e);
            } else {
                console.error(`No method found in ${methodName} name`)
            }
        });
    },
    /*
    * Scroll
    * */
    scroll() {
        const attrName = 'data-scroll';
        const scrollElement = document.querySelector(`[${attrName}]`)
        if (scrollElement) {
            scrollElement.addEventListener("load", async () => {
                infiniteScroll(() => {
                    const methodName = scrollElement.getAttribute(attrName);
                    if (hasMethod(methodName)) {
                        Methods[methodName]({obj: scrollElement});
                    } else {
                        console.error(`No method found in ${methodName} name`)
                    }
                })
            });
            const event = new Event("load");
            scrollElement.dispatchEvent(event);
        }
    },
    /*
    * Submit
    * */
    submit() {
        const self = this;
        const formObj = $('[data-content="form"]');
        if (formObj && formObj.length) {
            formObj.submit(async function (e) {
                e.preventDefault();
                const loading = self.data.loading;
                const obj = $(this);
                const url = obj.attr('data-url');
                const button = obj.find('button[type=submit]');
                const formFieldArr = {};
                await Array.from($(obj).serializeArray()).forEach(val => formFieldArr[val.name] = val.value);
                formFieldError(formFieldArr, obj);
                if (button.length) button.prepend(loading);
                const api = await fetchPost(url, formFieldArr);
                const res = await api.json();
                if (button.length) button.find('.svgLoading').remove();

                if (api.status === 200) {

                    formFieldReset(obj);

                    if (res?.message) {
                        toastr.info(res.message);
                    }

                    if (res?.reload) {
                        if (res?.time) {
                            setTimeout(function () {
                                window.location.reload();
                            }, parseFloat(res.time) * 1000);
                        }
                        else {
                            window.location.reload();
                        }
                        return false;
                    }

                    if (res?.redirect) {
                        if (res?.time) {
                            setTimeout(function () {
                                window.location.href = res.redirect;
                            }, parseFloat(res.time) * 1000);
                        }
                        else {
                            window.location.href = res.redirect;
                        }
                        return false;
                    }
                } else if (api.status === 422) {
                    formFieldError(res, obj, true);
                } else {
                    if (res?.message) {
                        toastr.error(res.message);
                    }
                }
            })
        }
    }
}

export default DataAttribute;
