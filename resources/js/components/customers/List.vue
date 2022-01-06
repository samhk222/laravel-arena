<template>
    <table width="90%" class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th width="1%">#</th>
                <th>Name</th>
                <th width="*">Document</th>
                <th width="10%">Status</th>
                <th width="5%">Created at</th>
                <th width="1%" nowrap>Phones</th>
                <th width="1%" nowrap>Edit</th>
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
                    <span class="fa-stack fa-1x pointer">
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
            </tr>
        </tbody>
    </table>
</template>
<script>
    import EventBus from "@/event-bus";
    export default {
        name: "CustomerList",
        props: {
            customers: {
                type: Object,
                default: () => {},
            },
        },
        components: {},
        mixins: [],
        data() {
            return {};
        },
        created() {},
        methods: {
            emitEdit(id) {
                EventBus.$emit("CUSTOMER_EDIT", id);
            },
        },
    };
</script>
<style lang="scss"></style>
