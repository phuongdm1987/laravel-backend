<template>
    <div>
        <button class="button is-info" @click="isActive = !isActive">Sale this product</button>
        <div class="modal" :class="{'is-active': isActive}">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title"><slot name="title">Default title</slot></p>
                    <button class="delete" aria-label="close" @click="cancel"></button>
                </header>
                <section class="modal-card-body">
                    <slot>Default content</slot>
                </section>
                <slot name="footer">
                    <footer class="modal-card-foot">
                        <button class="button is-success" @click="confirm">{{btnSubmit}}</button>
                        <button class="button" @click="cancel">{{btnCancel}}</button>
                    </footer>
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Modal",
        props: {
            onConfirm: {
                type: Function,
                default: () => {
                }
            },
            onCancel: {
                type: Function,
                default: () => {
                }
            },
            isActive: {
                type: Boolean,
                default: false
            },
            btnSubmit: {
                type: String,
                default: 'Save changes'
            },
            btnCancel: {
                type: String,
                default: 'Cancel'
            }
        },
        methods: {
            confirm() {
                this.onConfirm.apply(null, arguments)
                this.isActive = false
                this.$emit('close')
            },
            cancel() {
                this.onCancel.apply(null, arguments)
                this.isActive = false
                this.$emit('close')
            }
        }
    }
</script>

<style scoped>

</style>
