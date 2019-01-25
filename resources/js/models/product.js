import Config from '../configs/config'

class Product {
    constructor() {
        this.endpoint = Config.getApiEndPoint() + 'products'
        this.detailEndpoint = Config.getEndPoint() + 'products'
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
