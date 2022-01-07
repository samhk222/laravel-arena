<template>
    <div>
        <loading-bar v-if="loading"></loading-bar>
        <table width="90%" class="table table-striped table-bordered table-condensed table-hover" v-else>
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th>Number</th>
                    <th width="*">Customer</th>
                    <th width="10%">Status</th>
                    <th width="5%">Created at</th>
                    <th width="2%" class="text-center" nowrap>Edit</th>
                    <th width="2%" class="text-center" nowrap>Preferences</th>
                    <th width="2%" class="text-center" nowrap>Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="number in numbers.data" :key="number.id">
                    <td v-html="number.id" class="text-center"></td>
                    <td v-html="number.number"></td>
                    <td v-html="number.customer.name"></td>
                    <td v-html="number.status.badge" class="text-center"></td>
                    <td v-html="number.created_at_show" nowrap></td>
                    <td class="text-center pointer" @click="emitEdit(number.id)">
                        <span class="fa-stack fa-1x pointer">
                            <i class="far fa-square fa-stack-2x"></i>
                            <i class="fas fa-pen-square fa-stack-1x"></i>
                        </span>
                    </td>
                    <td class="text-center pointer" @click="openPreferences(number)">
                        <span class="fa-stack fa-1x pointer">
                            <i class="far fa-square fa-stack-2x"></i>
                            <i class="fas fa-broadcast-tower fa-stack-1x"></i>
                        </span>
                    </td>
                    <td class="text-center pointer" @click="openDelete(number)">
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
    import NumberPreferenceModal from "@/modais/number-preferences/Index.vue";
    import NumberDeleteModal from "@/modais/number/Delete.vue";
    import NumberApi from "@/vue/api/endpoints/Numbers";

    export default {
        name: "NumberList",
        props: {
            loading: {
                type: Boolean,
                default: false,
            },
            numbers: {
                type: Object,
                default: () => {},
            },
            mask: {
                type: String,
                default: "",
            },
        },
        components: { LoadingBar, NumberPreferenceModal, NumberDeleteModal },
        mixins: [],
        data() {
            return {};
        },
        created() {},
        methods: {
            openPreferences(number) {
                NumberApi.preferences(number.id).then((response) => {
                    this.$modal.show(
                        NumberPreferenceModal,
                        {
                            items: response.data,
                            number: number,
                        },
                        { width: 800, scrollable: true, height: 500 }
                    );
                });
            },
            openDelete(number) {
                this.$modal.show(
                    NumberDeleteModal,
                    {
                        number: number,
                        mask: this.mask,
                    },
                    { width: 800, scrollable: true, height: 300 }
                );
            },
            emitEdit(id) {
                EventBus.$emit("NUMBER_EDIT", id);
            },
        },
    };
</script>
<style lang="scss"></style>
