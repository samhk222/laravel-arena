<template>
    <div id="modal-container">
        <h3>Delete customer</h3>
        <div class="form-row mb-2">
            <div class="col">
                to confirm the deletion, you must enter it's name (<strong>{{ customer.name }}</strong
                >) on the form field.
            </div>
        </div>
        <div class="form-row mb-2">
            <div class="col">
                <label>Customer name</label>
                <input type="text" v-model="record.name" class="form-control" />
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
    import CustomerApi from "@/vue/api/endpoints/Customers";
    import EventBus from "@/event-bus";

    export default {
        name: "CustomerDeleteModal",
        components: {},
        mixins: [],
        props: {
            customer: {
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
                return this.record.name !== this.customer.name;
            },
        },
        created() {},
        methods: {
            destroy() {
                CustomerApi.destroy(this.customer.id)
                    .then((response) => {
                        EventBus.$emit("DESTROY_CUSTOMER", this.customer);
                        this.$swal.fire({
                            icon: "success",
                            title: "Customer deleted",
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
