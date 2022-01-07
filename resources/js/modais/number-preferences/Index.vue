<template>
    <div id="placeholder">
        <h3>Preferences - {{ number.number }}</h3>
        <div v-if="!hasItems">No preferences found</div>
        <table width="90%" class="table table-striped table-bordered table-condensed table-hover" v-else>
            <thead>
                <tr>
                    <th width="1%">#</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th class="text-center">Save</th>
                    <th class="text-center">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr is="NumberPreferenceEditForm" v-for="item in items" :key="item.id" :number-preference="item"></tr>
            </tbody>
        </table>

        <h3>New preference</h3>
        <number-preference-create-form :number="number" @preference-created="preferenceCreated" />
    </div>
</template>
<script>
    import NumberPreferenceEditForm from "@/components/number-preference/Edit";
    import NumberPreferenceCreateForm from "@/components/number-preference/Create";
    export default {
        name: "NumberPreferencesIndex",
        props: {
            items: {
                type: Array,
                default: () => [],
            },
            number: {
                type: Object,
                default: () => {},
            },
        },
        components: { NumberPreferenceEditForm, NumberPreferenceCreateForm },
        mixins: [],
        data() {
            return {};
        },
        computed: {
            hasItems() {
                return this.items.length > 0;
            },
        },
        created() {},
        methods: {
            preferenceCreated(event) {
                this.items.push(event);
            },
        },
    };
</script>
<style lang="scss" scoped>
    #placeholder {
        margin: 20px;
    }
</style>
