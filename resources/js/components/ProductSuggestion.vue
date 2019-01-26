<template>
    <suggestion
        v-model="query"
        :options="options"
        :isLoading="isLoading"
        :onItemSelected="onItemSelected"
        :onInputChange="onInputChange">
        <div slot="item" slot-scope="props" class="single-item">
            <a>{{props.item.name}}</a>
        </div>
    </suggestion>
</template>

<script>
    import Product from '../models/product'

    export default {
        name: "ProductSuggestion",
        data () {
            return {
                query: '',
                items: [],
                options: {
                    inputClass: 'input is-large',
                    placeholder: 'Search every thing',
                    debounce: 500
                },
                isLoading: false,
                product: new Product()
            }
        },
        methods: {
            onInputChange (query) {
                this.isLoading = true
                query = query.trim()
                if (query.length === 0) {
                    this.setLoaded()
                    return null
                }

                return this.product.all((products) => this.items = products, query)
                    .then(this.setLoaded())

                // return the matching countries as an array
                // return this.items.filter((country) => {
                //     return country.toLowerCase().includes(query.toLowerCase())
                // })
            },
            onItemSelected (item) {
                window.location.href = this.product.getUrl(item.slug)
            },
            setLoaded () {
                setTimeout(() => {this.isLoading = false}, 100)
            }
        }
    }
</script>

<style scoped>

</style>
