import Errors from './errors'

class Form {
    constructor(data) {
        this.originalData = data

        for (let field in data) {
            this[field] = data[field]
        }
        this.submitting = false;
        this.errors = new Errors()
    }

    reset() {
        for (let field in this.originalData) {
            this[field] = '';
        }

        this.errors.clear()
    }

    data() {
        let data = {}

        for (let property in this.originalData) {
            data[property] = this[property]
        }

        return data
    }

    post(url) {
        return this.submit('post', url)
    }

    delete(url) {
        return this.submit('delete', url)
    }

    submit(method, url) {
        this.submitting = true
        return new Promise((resolve, reject) => {
            axios[method](url, this.data())
                .then(response => {
                    this.onSuccess(response.data)
                    this.submitting = false
                    resolve(response.data)
                })
                .catch(error => {
                    this.onFail(error.response.data.errors)
                    this.submitting = false
                    reject(error.response.data.errors)
                })
        })
    }

    onSuccess(data) {
        alert(data.message)
        this.reset()
    }

    onFail(errors) {
        this.errors.record(errors)
    }
}

export default Form
