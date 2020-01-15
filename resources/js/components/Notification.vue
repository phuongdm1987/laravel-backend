<template>
    <div v-show="visible" :class="stateClass">
        <button class="delete" @click="hidden"></button>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        name: "Notification",
        data() {
            return {
                visible: true
            }
        },
        props: {
            state: {
                type: String,
                default: 'is-success'
            }
        },
        methods: {
            hidden() {
                this.visible = false
            }
        },
        computed: {
            stateClass() {
                return 'notification ' + this.state
            }
        }
    }
</script>

<style scoped>

</style>
