import Config from '../classes/config'

class Product {
    constructor() {
        let config = new Config()
        this.endpoint = config.getApiEndPoint() + 'products'
    }

    all(then, query = '') {
        let url = this.endpoint + '?q=' + query
        return axios.get(url)
            .then(({data}) => then(data))
    }
}

export default Product
