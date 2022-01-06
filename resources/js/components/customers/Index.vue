<script>
    import CustomerApi from "@/vue/api/endpoints/Customers";
    import pagination from "laravel-vue-pagination";

    export default {
        name: "CustomerIndex",
        props: {},
        components: { pagination },
        mixins: [],
        data() {
            return {};
        },
        created() {
            this.getResults();
        },
        methods: {
            getResults(page = 1) {
                CustomerApi.paginated(page).then((response) => {
                    this.records = response.data;
                });
            },
        },
    };
</script>
<style lang="scss"></style>
