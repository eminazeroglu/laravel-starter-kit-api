const headers = {
    'Accept': 'application/json',
    'Content-Type': 'application/json; charset=UTF-8',
    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
    'Web': 'true'
}

export const fetchPost = async (url, params) => {
    return await fetch(url, {
        method: 'POST',
        headers,
        body: JSON.stringify(params)
    });
}

export const fetchGet = async (url, params = {}) => {
    return await fetch(url + (Object.values(params).length ? '?' + new URLSearchParams(params) : ''), {
        method: 'GET',
        headers
    });
}
