<template>
    <div>
        <treeselect v-model="customer_id" :multiple="false" :clearable="false" :async="true" :load-options="loadOptions" search-prompt-text="Type customer name ..." />
    </div>
</template>
<script>
    import CustomerApi from "@/vue/api/endpoints/Customers";
    import { ASYNC_SEARCH, Treeselect } from "@riophae/vue-treeselect";
    import "@riophae/vue-treeselect/dist/vue-treeselect.css";

    export default {
        name: "SharedCustomers",
        components: { Treeselect },
        mixins: [],
        props: {
            customerId: {
                type: [Number, String],
                default: 0,
            },
        },
        data() {
            return {
                customers: [],
                customer_id: null,
            };
        },
        watch: {
            customerId(newVal) {
                if (newVal != 0) {
                    this.customer_id = this.customerId;
                }
            },
            customer_id(newVal) {
                this.$emit("change", newVal);
            },
        },
        created() {},
        methods: {
            loadOptions({ action, searchQuery, callback }) {
                if (action === ASYNC_SEARCH) {
                    setTimeout(() => {
                        CustomerApi.index({ term: searchQuery })
                            .then((response) => {
                                const options = response.data.data.map((i) => ({
                                    id: `${i.id}`,
                                    label: `${i.name}`,
                                }));
                                callback(null, options);
                            })
                            .catch((e) => {
                                this.Errors = e;
                            });
                    }, 300);
                }
            },
        },
    };
</script>
<style lang="scss"></style>
