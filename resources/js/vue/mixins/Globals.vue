<script>
    import Errors from "@/vue/shared/Errors";
    import Success from "@/vue/shared/Success";
    import moment from "moment";

    export default {
        name: "MixinGlobals",
        components: { Errors, Success },
        filters: {
            currency: function (value) {
                const formatter = new Intl.NumberFormat("pt-BR", {
                    style: "currency",
                    currency: "BRL",
                    minimumFractionDigits: 2,
                });

                let color = value < 0 ? "red" : "blue";

                return `<font color='${color}'>${formatter.format(value)}</font>`;
            },
        },
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
                Success: "",
                editMode: false,
                showSuccess: false,
                record: [],
            };
        },
        computed: {
            saveEditLabel() {
                return this.editMode ? "Atualizar" : "Cadastrar";
            },
        },
        watch: {
            Success(newVal) {
                if (newVal != "" || newVal != null) {
                    this.showSuccess = true;
                } else {
                    this.showSuccess = false;
                }
            },
        },
        created() {
            this.record["dt_record"] = moment(new Date()).format("YYYY-MM-DD");
            if (this.defaultData) {
                this.record = this.defaultData;
            }
        },
        methods: {
            deleteByIndex(data, id) {
                data.splice(
                    data.findIndex((el) => el.id === id),
                    1
                );
            },

            porcentagem(pPos, pEarned, formated) {
                pPos = Math.abs(pPos);
                pEarned = Math.abs(pEarned);
                var perc = "0%";
                if (isNaN(pPos) || isNaN(pEarned)) {
                    perc = " ";
                } else {
                    perc = ((pEarned / pPos) * 100).toFixed(2);
                }

                if (formated) {
                    return perc + "%";
                }
                return perc;
            },
            clearMessages() {
                this.Errors = [];
                this.showSuccess = false;
            },
            currency(value, format) {
                const formatter = new Intl.NumberFormat("pt-BR", {
                    style: "currency",
                    currency: "BRL",
                    minimumFractionDigits: 2,
                });

                if (format == true) {
                    let color = value < 0 ? "red" : "blue";
                    return `<font color='${color}'>${formatter.format(value)}</font>`;
                }
                return formatter.format(value);
            },
            convertDbDateToPtBr(date, inputformat = "YYYY-MM-DD HH:mm:ss", outputformat = "DD/MM/YYYY") {
                let converted_date = moment(date, inputformat);
                return converted_date.format(outputformat);
            },
        },
    };
</script>
