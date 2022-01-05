<template>
    <div>
        <select v-model="categoria_id" class="form-control">
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{ categoria.descricao }}</option>
        </select>
    </div>
</template>
<script>
    import CategoriasApi from "@/vue/api/endpoints/Categorias";

    export default {
        name: "SelectBancos",
        components: {},
        mixins: [],
        props: {
            default: {
                type: Number,
                default: 0,
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
                this.categorias.push({ id: null });
                CategoriasApi.genericIndex("bancos").then((response) => {
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
