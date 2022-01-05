<template>
    <div v-if="show" class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Sucesso</h5>
        <li>{{ title }}</li>
    </div>
</template>
<script>
    export default {
        name: "SharedErrors",
        components: {},
        mixins: [],
        props: {
            title: {
                type: String,
                default: "",
            },
            show: {
                type: Boolean,
                default: false,
            },
        },
        data() {
            return {};
        },
        computed: {
            hasTitle() {
                return this.title != "";
            },
        },
    };
</script>
<style lang="scss"></style>
