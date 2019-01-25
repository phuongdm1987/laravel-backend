import Config from '../configs/config'
import axios from 'axios'

class Auth {
    constructor() {
        this.loginEndpoint = Config.getApiEndPoint() + 'login'
        this.logoutEndpoint = Config.getApiEndPoint() + 'logout'

        this.token = window.localStorage.getItem('token')

        let userData = window.localStorage.getItem('user')
        this.user = userData ? JSON.parse(userData) : null;

        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token
        }
    }

    login() {
        let token = window.localStorage.getItem('token')
        if (token) {
            return
        }

        axios.post(this.loginEndpoint, {
            client_id: Config.getClientId(),
            client_secret: Config.getClientSecret(),
            email: Config.getEmail(),
            password: Config.getPassword(),
        }).then(({data}) => {
            localStorage.setItem('token', data.token)
            localStorage.setItem('user', JSON.stringify(data.user))
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + data.token;
        })

    }

    logout() {
        axios.get(this.logoutEndpoint)

        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }
}

export default new Auth
