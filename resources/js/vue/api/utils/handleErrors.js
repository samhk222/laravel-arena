export default function handleErrors(error) {
    const err = JSON.parse(error.request.response);
    let messageError = [];

    if (error.response.status === 500) {
        messageError = ["Ocorreu um erro no sistema. Tente novamente."];
    }

    if (error.response.status === 422) {
        messageError = Object.values(err.errors || {})
            .map((x) => {
                return Array.isArray(x) ? x[0] : x;
            })
            .filter((x, i, arr) => arr.indexOf(x) === i);
    }

    if (error.response.status === 403) {
        messageError = ["Only admins can perform this action"];
    }

    return Promise.reject(messageError);
}
