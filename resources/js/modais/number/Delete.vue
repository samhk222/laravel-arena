<template>
    <div id="modal-container">
        <h3>Delete number: {{ number.number }}</h3>
        <div class="form-row mb-2">
            <div class="col">
                to confirm the deletion, you must enter the number (<strong>{{ number.number }}</strong
                >) on the form field.
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col">
                <label>Number</label>
                <input type="text" v-mask="'##-####'" v-model="record.value" class="form-control" />
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col text-right">
                <label for="">&nbsp;</label><br />
                <input :disabled="disableButton" type="button" value="Excluir" class="btn btn-danger" @click="destroy" />
            </div>
        </div>
    </div>
</template>
<script>
    import NumberApi from "@/vue/api/endpoints/Numbers";
    import EventBus from "@/event-bus";

    export default {
        name: "NumberDelete",
        components: {},
        mixins: [],
        props: {
            number: {
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
                return this.record.value !== this.number.number;
            },
        },
        created() {},
        methods: {
            destroy() {
                NumberApi.destroy(this.number.id)
                    .then((response) => {
                        EventBus.$emit("DESTROY_NUMBER", this.number);
                        this.$swal.fire({
                            icon: "success",
                            title: "Number deleted",
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                        });
                        this.$modal.hideAll();
                    })
                    .catch((e) => {
                        this.Errors = e;
                    });
            },
        },
    };
</script>
