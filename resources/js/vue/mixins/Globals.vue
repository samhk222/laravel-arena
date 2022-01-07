<script>
    import Errors from "@/vue/shared/Errors";
    import Success from "@/vue/shared/Success";
    import LoadingBar from "@/vue/shared/LoadingBar";
    import moment from "moment";

    export default {
        name: "MixinGlobals",
        components: { Errors, Success, LoadingBar },
        mixins: [],
        props: {
            defaultData: {
                type: Object,
                default: () => {},
            },
        },
        data() {
            return {
                Errors: [],
                success_message: "",
                editMode: false,
                record: {},
                records: {
                    type: Object,
                    default: () => {},
                },
            };
        },
        computed: {
            saveEditLabel() {
                return this.editMode ? "Update" : "Create";
            },
            hasRecords() {
                if (this.records.hasOwnProperty("data")) {
                    return this.records.data.length > 0;
                }
                return this.records.length > 0;
            },
        },
        watch: {},
        created() {
            if (this.defaultData) {
                this.record = this.defaultData;
            }
        },
        methods: {
            findRecordById(id) {
                return this.records.data.findIndex((el) => el.id === id);
            },
            deleteByIndex(data, id) {
                data.splice(this.findRecordById(id), 1);
            },
            recordCreated(record) {
                this.records.data.unshift(record);
                this.editMode = false;
            },
            recordEdited(record) {
                Vue.set(this.records.data, this.findRecordById(record.id), record);
                this.editMode = false;
            },
            clearMessages() {
                this.Errors = [];
                this.success_message = "";
            },
            clearObject(except) {
                for (var prop in this.record) {
                    if (this.record.hasOwnProperty(prop) && prop != except) {
                        this.record[prop] = "";
                    }
                }
            },
        },
    };
</script>
