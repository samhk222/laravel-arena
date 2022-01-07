<script>
    import NumberApi from "@/vue/api/endpoints/Numbers";
    import pagination from "laravel-vue-pagination";
    import EventBus from "@/event-bus";

    export default {
        name: "NumberIndex",
        props: {
            customerId: {
                type: Number,
                default: null,
            },
        },
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
            EventBus.$on("DESTROY_NUMBER", (number) => {
                this.deleteByIndex(this.records.data, number.id);
            });
        },
        watch: {
            searchInput: function () {
                this.isLoading = true;
                this.debounceInput();
            },
        },
        methods: {
            debounceInput: _.debounce(function () {
                NumberApi.index({ term: this.searchInput })
                    .then((r) => {
                        this.records = r.data;
                    })
                    .finally((r) => {
                        this.isLoading = false;
                    });
            }, 500),
            getResults(page = 1) {
                this.isLoading = true;
                NumberApi.paginated(page, { customer_id: this.customerId })
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
