<script>
    import CustomerApi from "@/vue/api/endpoints/Customers";
    import pagination from "laravel-vue-pagination";

    export default {
        name: "CustomerIndex",
        props: {},
        components: { pagination },
        mixins: [],
        data() {
            return {
                searchInput: null,
                isLoading: false,
            };
        },
        created() {
            this.getResults();
        },
        watch: {
            searchInput: function () {
                this.isLoading = true;
                this.debounceInput();
            },
        },
        methods: {
            debounceInput: _.debounce(function () {
                CustomerApi.index({ term: this.searchInput })
                    .then((r) => {
                        this.records = r.data;
                    })
                    .finally((r) => {
                        this.isLoading = false;
                    });
            }, 500),
            getResults(page = 1) {
                this.isLoading = true;
                CustomerApi.paginated(page)
                    .then((response) => {
                        this.records = response.data;
                    })
                    .finally((r) => {
                        this.isLoading = false;
                    });
            },
        },
    };
</script>
<style lang="scss"></style>
