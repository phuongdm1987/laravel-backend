import Config from '../configs/config'

class Product {
    constructor() {
        let config = new Config()
        this.endpoint = config.getApiEndPoint() + 'products'
        this.detailEndpoint = config.getEndPoint() + 'products'
    }

    all(then, query = '') {
        let url = this.endpoint + '?q=' + query
        return Api.get(url).then(({data}) => then(data))
    }

    getUrl(slug) {
        return this.detailEndpoint + '/' + slug
    }
}

export default Product
