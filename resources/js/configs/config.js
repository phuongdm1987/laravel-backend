class Config {
    constructor() {
        this.endPoint = process.env.MIX_APP_URL
    }

    getEndPoint() {
        return this.endPoint + '/'
    }

    getApiEndPoint() {
        return this.getEndPoint() + 'api/'
    }
}

export default Config
