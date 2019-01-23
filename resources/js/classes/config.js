class Config {
    constructor() {
        this.apiEndPoint = 'http://backend.local:8080/api/'
    }

    getApiEndPoint() {
        return this.apiEndPoint
    }
}

export default Config
