<template>
    <div v-if="show" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="messageActive = ''">×</button>
        <h5><i class="icon fas fa-ban"></i> Success</h5>
        {{ messageActive }}
    </div>
</template>
<script>
    export default {
        name: "SharedErrors",
        components: {},
        mixins: [],
        props: {
            message: {
                type: String,
                default: "",
            },
        },
        data() {
            return {
                messageActive: "",
            };
        },
        watch: {
            message(newVal) {
                this.messageActive = newVal;
            },
        },
        created() {
            this.messageActive = this.message;
        },
        computed: {
            show() {
                return this.messageActive != "";
            },
        },
    };
</script>
<style lang="scss"></style>
