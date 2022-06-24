<template>
    <div>
        <apexchart width="380" type="donut" :options="options" :series="series"> </apexchart>
    </div>
</template>
<script>
    import VueApexCharts from "vue-apexcharts";
    import DashboardApi from "@/vue/api/endpoints/Dashboard";

    export default {
        name: "CustomersGroupedByStatus",
        props: {},
        components: { apexchart: VueApexCharts },
        mixins: [],
        data: () => ({
            options: {
                legend: {
                    show: true,
                    position: "top",
                },

                labels: [],
            },
            series: [],
        }),
        created() {
            this.getData();
        },
        methods: {
            getData() {
                DashboardApi.getCustomersGroupedByStatus().then((r) => {
                    let labels = [];
                    let values = [];
                    this.options = {
                        labels: Object.keys(r),
                    };
                    this.series = Object.values(r);
                });
            },
            change() {},
        },
    };
</script>
<style lang="scss"></style>
