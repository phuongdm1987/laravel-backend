<template>
    <div class="wrapper-suggestions">
        <input type="text" v-model="query">
        <div class="suggestions">
            <ul class="items" v-show="isShowItems()">
                <li class="item"
                    v-for="(item, index) in items"
                    :key="index"
                    :class="{'is-active': isCurrentItem(index)}">
                    <slot name="item" :item="item">{{item}}</slot>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Suggestion",
        props: {
            options: {
                type: Object,
                default: {}
            },
            value: {
                type: String,
                require: true
            },
            onInputChange: {
                type: Function,
                require: true
            }
        },
        data() {
            const defaultOptions = {
                debounce: 0,
                placeholder: '',
                inputClass: 'input'
            }
            const extendedOptions = Object.assign({}, defaultOptions, this.options)

            return {
                extendedOptions,
                query: this.value,
                items: [],
                lastSetQuery: null,
                activeItemIndex: -1,
                showItems: false
            }
        },
        beforeMount() {
            if (this.extendedOptions.debounce !== 0) {
                this.onQueryChanged = _.debounce(this.onQueryChanged, this.extendedOptions.debounce)
            }
        },
        watch: {
            'query': function (newValue, oldValue) {
                if (newValue === this.lastSetQuery) {
                    this.lastSetQuery = null
                    return
                }
                this.onQueryChanged(newValue)
                Event.fire('input', newValue)
            },
            'value': function (newValue, oldValue) {
                this.setInputQuery(newValue)
            }
        },
        methods: {
            setInputQuery (value) {
                this.lastSetQuery = value
                this.query = value
            },
            onQueryChanged (value) {
                const result = this.onInputChange(value)
                this.items = []
                if (typeof result === 'undefined' || typeof result === 'boolean' || result === null) {
                    return
                }
                if (result instanceof Array) {
                    this.setItems(result)
                } else if (typeof result.then === 'function') {
                    result.then(items => {
                        this.setItems(items)
                    })
                }
            },
            setItems (items) {
                this.items = items
                this.activeItemIndex = -1
                this.showItems = true
            },
            isShowItems() {
                return this.items.length > 0 && this.showItems === true
            },
            isCurrentItem(currentIndex) {
                return currentIndex === this.activeItemIndex
            }
        }
    }
</script>

<style scoped>
    .wrapper-suggestions {
        position: relative;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }

    .wrapper-suggestions .suggestions {
        position: absolute;
        left: 0;
        top: 36px;
        width: 100%;
        z-index: 100;
        background: #ffffff;
    }
</style>
