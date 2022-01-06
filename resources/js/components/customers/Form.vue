<template>
    <div>
        <div class="form-row">
            <div class="col-md-12">
                <errors :errors="Errors"></errors>
                <success :message="success_message"></success>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" class="form-control" v-model="record.name" />
            </div>
            <div class="col-md-6">
                <label>Document</label>
                <input type="text" class="form-control" v-model="record.document" maxlength="12" />
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
    import CustomerApi from "@/vue/api/endpoints/Customers";
    import EventBus from "@/event-bus";

    export default {
        name: "CustomerForm",
        props: {
            statuses: {
                type: Array,
                default: () => [],
            },
        },
        components: {},
        mixins: [],
        data() {
            return {
                record: {
                    name: "",
                    document: "",
                    status_id: null,
                },
            };
        },
        created() {
            EventBus.$on("CUSTOMER_EDIT", (id) => {
                this.clearMessages();
                CustomerApi.get(id).then(({ data }) => {
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
                    CustomerApi.store(this.record)
                        .then((response) => {
                            this.$emit("created", response.data);
                            this.clearObject();
                            this.success_message = "Customer created";
                        })
                        .catch((e) => {
                            this.Errors = e;
                        });
                } else {
                    CustomerApi.update(this.record.id, this.record)
                        .then((response) => {
                            this.$emit("edited", response.data);
                            this.clearObject();
                            this.success_message = "Customer updated";
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
