<template>
    <div>
        <apexchart width="500" type="bar" :options="options" :series="series"> </apexchart>
    </div>
</template>
<script>
    import VueApexCharts from "vue-apexcharts";
    import DashboardApi from "@/vue/api/endpoints/Dashboard";

    export default {
        name: "NumbersByStatus",
        props: {},
        components: { apexchart: VueApexCharts },
        mixins: [],
        data: () => ({
            options: {
                chart: {
                    id: "vuechart-numbers-by-status",
                },
                xaxis: {
                    categories: [],
                },
            },

            series: [
                {
                    name: "series-1",
                    data: [],
                },
            ],
        }),
        created() {
            this.getData();
        },
        methods: {
            getData() {
                DashboardApi.getNumbersGroupedByStatus().then((r) => {
                    let categories = [];
                    let values = [];
                    let colors = [];
                    _.forEach(r, (value) => {
                        colors.push(value.color);
                        categories.push(value.description);
                        values.push(value.total);
                    });

                    this.options = {
                        xaxis: {
                            categories: categories,
                        },
                    };
                    this.series = [
                        {
                            name: "Total Numbers",
                            data: values,
                        },
                    ];
                });
            },
            change() {},
        },
    };
</script>
<style lang="scss"></style>
