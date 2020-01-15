class Configuration {
    constructor() {
        this.endPoint = process.env.MIX_APP_URL
    }

    getEndPoint() {
        return this.endPoint + '/'
    }

    getApiEndPoint() {
        return this.getEndPoint() + 'api/'
    }

    getClientId() {
        return process.env.MIX_API_CLIENT_ID
    }

    getClientSecret() {
        return process.env.MIX_API_CLIENT_SECRET
    }

    getEmail() {
        return process.env.MIX_API_EMAIL
    }

    getPassword() {
        return process.env.MIX_API_PASSWORD
    }
}

export default new Configuration
