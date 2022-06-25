<script>
    import NumbersByStatus from "../graphs/NumbersByStatus";
    import CustomersByStatus from "../graphs/CustomersByStatus";
    export default {
        name: "DashboardIndex",
        components: { NumbersByStatus, CustomersByStatus },
        data: () => ({
            steps: [
                {
                    target: ".inner", // We're using document.querySelector() under the hood
                    content: `Discover <strong>Vue Tour</strong>!`,
                },
                {
                    target: "#teste", // We're using document.querySelector() under the hood
                    content: `Olha que top`,
                },
                {
                    target: "#teste2", // We're using document.querySelector() under the hood
                    content: `Olha que inner`,
                },
            ],
            options: {
                chart: {
                    id: "vuechart-example",
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                },
            },
            series: [
                {
                    name: "series-1",
                    data: [55, 62, 89, 66, 98, 72, 101, 75, 94, 120, 117, 139],
                },
            ],
        }),
        mounted() {
            this.$tours["myTour"].start();
        },
    };
</script>
