<template>
    <div v-show="visible" class="notification is-success">
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
        methods: {
            hidden() {
                this.visible = false
            }
        }
    }
</script>

<style scoped>

</style>
