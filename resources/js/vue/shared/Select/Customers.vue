<template>
    <div>
        <treeselect v-model="categoria_id" :multiple="false" :options="categorias" placeholder="Escolha" />
    </div>
</template>
<script>
    import CategoriasApi from "@/vue/api/endpoints/Categorias";
    import Treeselect from "@riophae/vue-treeselect";
    import "@riophae/vue-treeselect/dist/vue-treeselect.css";

    export default {
        name: "SharedCategorias",
        components: { Treeselect },
        mixins: [],
        props: {
            default: {
                type: Number,
                default: 0,
            },
            scheme: {
                type: String,
                default: "",
            },
        },
        data() {
            return {
                categorias: [],
                categoria_id: null,
            };
        },
        watch: {
            categoria_id(newVal) {
                this.$emit("change", newVal);
            },
            default(newVal) {
                this.categoria_id = newVal;
            },
        },
        created() {
            this.getRecords();
        },
        methods: {
            getRecords() {
                CategoriasApi.treeView({ scheme: this.scheme || null }).then((response) => {
                    response.data.forEach((element) => {
                        this.categorias.push(element);
                    });
                    this.categoria_id = this.default;
                });
            },
        },
    };
</script>
<style lang="scss"></style>
