<template>
    <div v-if="hasErrors" class="alert alert-danger">
        <button type="button" class="close" @click="errorsShow = []">×</button>
        <h5><i class="icon fas fa-ban"></i> Erro!</h5>
        <li v-for="error in errors" :key="error.id">{{ error }}</li>
    </div>
</template>
<script>
    export default {
        name: "SharedErrors",
        components: {},
        mixins: [],
        props: {
            errors: {
                type: [Array, Error],
                default: () => [],
            },
        },
        data() {
            return {
                errorsShow: [],
            };
        },
        computed: {
            hasErrors() {
                return this.errorsShow.length > 0;
            },
        },
        watch: {
            errors(newVal) {
                this.errorsShow = newVal;
            },
        },
        created() {
            this.errorsShow = this.errors;
        },
        methods: {},
    };
</script>
