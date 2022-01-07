<template>
    <div>
        <loading-bar v-if="loading"></loading-bar>
        <table width="90%" class="table table-striped table-bordered table-condensed table-hover" v-else>
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th>Name</th>
                    <th width="*">Document</th>
                    <th width="10%">Status</th>
                    <th width="5%">Created at</th>
                    <th width="2%" class="text-center" nowrap>Phones</th>
                    <th width="2%" class="text-center" nowrap>Edit</th>
                    <th width="2%" class="text-center" nowrap>Edit</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="customer in customers.data" :key="customer.id">
                    <td v-html="customer.id" class="text-center"></td>
                    <td v-html="customer.name"></td>
                    <td v-html="customer.document"></td>
                    <td v-html="customer.status.badge" class="text-center"></td>
                    <td v-html="customer.created_at_show" nowrap></td>
                    <td class="text-center pointer">
                        <span class="fa-stack fa-1x pointer" @click="goToNumberEdit(customer.id)">
                            <i class="far fa-square fa-stack-2x"></i>
                            <i class="fas fa-phone-square fa-stack-1x"></i>
                        </span>
                    </td>
                    <td class="text-center pointer" @click="emitEdit(customer.id)">
                        <span class="fa-stack fa-1x pointer">
                            <i class="far fa-square fa-stack-2x"></i>
                            <i class="fas fa-pen-square fa-stack-1x"></i>
                        </span>
                    </td>
                    <td class="text-center pointer" @click="openDelete(customer)">
                        <span class="fa-stack fa-1x pointer delete">
                            <i class="far fa-square fa-stack-2x"></i>
                            <i class="fas fa-trash-alt fa-stack-1x"></i>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    import EventBus from "@/event-bus";
    import LoadingBar from "../../vue/shared/LoadingBar.vue";
    import CustomerDeleteModal from "@/modais/customer/Delete.vue";

    export default {
        name: "CustomerList",
        props: {
            loading: {
                type: Boolean,
                default: false,
            },
            customers: {
                type: Object,
                default: () => {},
            },
        },
        components: { LoadingBar, CustomerDeleteModal },
        mixins: [],
        data() {
            return {};
        },
        created() {},
        methods: {
            emitEdit(id) {
                EventBus.$emit("CUSTOMER_EDIT", id);
            },
            goToNumberEdit(customerId) {
                window.location = `/customers/${customerId}/numbers`;
            },
            openDelete(customer) {
                this.$modal.show(
                    CustomerDeleteModal,
                    {
                        customer: customer,
                    },
                    { width: 800, scrollable: true, height: 300 }
                );
            },
        },
    };
</script>
<style lang="scss"></style>
