import Auth from './auth'

class Api {

    _call(requestType, url, data = null) {
        Auth.login()
        return new Promise((resolve, reject) => {
            axios[requestType](url, data)
                .then(response => {
                    resolve(response)
                })
                .catch(({response}) => {
                    if (response.status === 401) {
                        Auth.logout()
                    }

                    reject(response)
                })
        })
    }

    get(url, data = null) {
        return this._call('get', url, data)
    }

    post(url, data = null) {
        return this._call('post', url, data)
    }

    put(url, data = null) {
        return this._call('put', url, data)
    }

    patch(url, data = null) {
        return this._call('patch', url, data)
    }

    delete(url, data = null) {
        return this._call('delete', url, data)
    }
}

export default new Api
