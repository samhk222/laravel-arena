<template>
    <div class="form-row">
        <div class="col-md-5">
            <label>Name</label>
            <input type="text" class="form-control" v-model="record.name" />
        </div>
        <div class="col-md-5">
            <label>Value</label>
            <input type="text" class="form-control" v-model="record.value" />
        </div>
        <div class="col-md-2 text-right">
            <label>&nbsp;</label><br />
            <input type="button" class="btn btn-primary" @click="save" value="Save" />
        </div>
    </div>
</template>
<script>
    import NumberPreferencesApi from "@/vue/api/endpoints/NumberPreferences";

    export default {
        name: "NumberPreferenceCreateForm",
        props: {
            number: {
                type: Object,
                default: () => {},
            },
        },
        components: {},
        mixins: [],
        data() {
            return {
                record: {
                    id: null,
                    number_id: this.number.id,
                    name: "",
                    value: "",
                },
            };
        },
        created() {},
        methods: {
            save() {
                NumberPreferencesApi.store(this.record)
                    .then((r) => {
                        this.$swal.fire({
                            icon: "success",
                            title: "Preference created",
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                        });
                        this.$emit("preference-created", r.data);
                        this.record.id = null;
                        this.record.name = "";
                        this.record.value = "";
                    })
                    .catch((e) => {
                        this.$swal.fire({
                            icon: "danger",
                            title: e,
                            toast: true,
                            position: "top-right",
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                        });
                    });
            },
        },
    };
</script>
<style lang="scss"></style>
