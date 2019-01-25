class Auth {
    constructor() {
        this.token = window.localStorage.getItem('token');

        let userData = window.localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;

        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
        }
    }

    login(token, user) {
        localStorage.setItem('token', token)
        localStorage.setItem('user', JSON.stringify(user))

        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    }
}

export default new Auth
