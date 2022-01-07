<template>
    <tr v-if="show">
        <td v-html="numberPreference.id"></td>
        <td><input type="text" class="form-control" v-model="record.name" /></td>
        <td><input type="text" class="form-control" v-model="record.value" /></td>
        <td class="text-center pointer" @click="save()">
            <span class="fa-stack fa-1x pointer">
                <i class="far fa-square fa-stack-2x"></i>
                <i class="fas fa-save fa-stack-1x"></i>
            </span>
        </td>
        <td class="text-center pointer" @click="destroy()">
            <span class="fa-stack fa-1x pointer delete">
                <i class="far fa-square fa-stack-2x"></i>
                <i class="fas fa-trash-alt fa-stack-1x"></i>
            </span>
        </td>
    </tr>
</template>
<script>
    import NumberPreferencesApi from "@/vue/api/endpoints/NumberPreferences";

    export default {
        name: "NumberPreferenceEditForm",
        props: {
            numberPreference: {
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
                    name: "",
                    value: "",
                },
                show: true,
            };
        },
        created() {
            this.record = this.numberPreference;
        },
        methods: {
            destroy() {
                NumberPreferencesApi.destroy(this.record.id)
                    .then((r) => {
                        this.show = false;
                        this.$swal.fire({
                            icon: "success",
                            title: "Preference deleted",
                            toast: true,
                            position: "top-middle",
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                        });
                    })
                    .catch((e) => {
                        this.$swal.fire({
                            icon: "danger",
                            title: e,
                            toast: true,
                            position: "top-center",
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                        });
                    });
            },
            save() {
                NumberPreferencesApi.update(this.record.id, this.record)
                    .then((r) => {
                        this.$swal.fire({
                            icon: "success",
                            title: "Preference updated",
                            toast: true,
                            position: "top-middle",
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true,
                        });
                    })
                    .catch((e) => {
                        this.$swal.fire({
                            icon: "danger",
                            title: e,
                            toast: true,
                            position: "top-center",
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
