<template>
    <div>
        <div class="form-row">
            <div class="col-md-12">
                <errors :errors="Errors"></errors>
                <success :message="success_message"></success>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6" v-if="!customerWasInputed">
                <label>Customer</label>
                <customers-select @change="record.customer_id = $event" :customer-id="record.customer_id"></customers-select>
            </div>
            <div :class="[!customerWasInputed ? 'col-md-6' : 'col-md-12']">
                <label>Number</label>
                <input type="text" class="form-control" v-model="record.number" v-mask="mask" :maxlength="maxSize" />
            </div>
        </div>
        <div class="form-row" v-if="editMode">
            <div class="col-md-6">
                <label>Status</label>
                <select v-model="record.status_id" class="form-control">
                    <option :value="status.id" v-for="status in statuses" :key="status.id">{{ status.description }}</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12 text-right">
                <label>&nbsp;</label><br />
                <input type="button" class="btn btn-primary" :value="saveEditLabel" @click="save" />
            </div>
        </div>
    </div>
</template>
<script>
    import NumberApi from "@/vue/api/endpoints/Numbers";
    import EventBus from "@/event-bus";
    import CustomersSelect from "@/vue/shared/Select/Customers.vue";
    export default {
        name: "NumberForm",
        props: {
            customerId: {
                type: Number,
                default: null,
            },
            statuses: {
                type: Array,
                default: () => [],
            },
            mask: {
                type: String,
                default: "",
            },
        },
        components: { CustomersSelect },
        computed: {
            customerWasInputed() {
                return this.customerId !== null && this.record.customer_id !== null;
            },
            maxSize() {
                return this.mask.length;
            },
        },
        mixins: [],
        data() {
            return {
                record: {
                    customer_id: this.customerId,
                    number: "",
                    status_id: null,
                },
            };
        },
        created() {
            EventBus.$on("NUMBER_EDIT", (id) => {
                this.clearMessages();
                NumberApi.get(id).then(({ data }) => {
                    this.record = data;
                    this.editMode = true;
                    window.scrollTo(0, 0);
                });
            });
        },
        methods: {
            save() {
                this.clearMessages();
                if (!this.editMode) {
                    NumberApi.store(this.record)
                        .then((response) => {
                            this.$emit("created", response.data);
                            this.clearObject("customer_id");
                            this.success_message = "Number created";
                        })
                        .catch((e) => {
                            this.Errors = e;
                        });
                } else {
                    NumberApi.update(this.record.id, this.record)
                        .then((response) => {
                            this.$emit("edited", response.data);
                            this.clearObject("customer_id");
                            this.editMode = false;
                            this.success_message = "Number updated";
                        })
                        .catch((e) => {
                            this.Errors = e;
                        });
                }
            },
        },
    };
</script>
<style lang="scss"></style>
