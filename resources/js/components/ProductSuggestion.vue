<template>
    <suggestion
        v-model="query"
        :options="options"
        :onItemSelected="onItemSelected"
        :onInputChange="onInputChange">
        <div slot="item" slot-scope="props" class="single-item">
            <a :href="'http://backend.local:8080/home?q=' + props.item">{{props.item}}</a>
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
                    debounce: 200
                }
            }
        },
        methods: {
            onInputChange (query) {
                query = query.trim()
                if (query.length === 0) {
                    return null
                }

                let product = new Product()
                return product.all(products => this.items = products, query)
                // return the matching countries as an array
                // return this.items.filter((country) => {
                //     return country.toLowerCase().includes(query.toLowerCase())
                // })
            },
            onItemSelected (item) {
                window.location.href = 'http://backend.local:8080/home?q=' + item
            }
        }
    }
</script>

<style scoped>

</style>
