<template>
    <div id="modal">
        <div class="form-row mb-4">
            <div class="md-col-12">
                <h2>Deleção</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <errors :errors="Errors" />
                <success v-if="showSuccess" :title="Success" />
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col">
                Para deleção, digite na caixa de seleção abaixo o valor correspondente : <strong> R$ {{ Math.abs(item.resource.value) }}</strong> <br />
                Descrição: <strong>{{ item.resource.descricao }}</strong>
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col">
                <label for="tbl">Valor</label>
                <money v-model="record.value" :value="0" class="form-control"></money>
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col text-right">
                <label for="">&nbsp;</label><br />
                <input :disabled="disableButton" type="button" value="Excluir" class="btn btn-danger" @click="save" />
            </div>
        </div>
    </div>
</template>
<script>
    import EventBus from "@/event-bus";

    export default {
        name: "DeleteGeneric",
        components: {},
        mixins: [],
        props: {
            item: {
                type: Object,
                default: () => {},
            },
        },
        data() {
            return {
                record: {},
            };
        },
        computed: {
            disableButton() {
                return Math.abs(this.item.resource.value) != Math.abs(this.record.value);
            },
        },
        created() {},
        methods: {
            save() {
                Api.destroy(this.item.id)
                    .then((response) => {
                        this.$modal.hideAll();
                        EventBus.$emit("REFRESH_LANCAMENTOS");
                    })
                    .catch((e) => {
                        this.Errors = e;
                    });
            },
        },
    };
</script>
<style lang="scss">
    #modal {
        margin: 30px;
    }
</style>
