import BaseMethods from "../BaseMethods";
import getData from "../utils/getData";

export default new class Customers extends BaseMethods {
    baseUrl = this.baseUrl + "/numbers";

    async preferences(numberId) {
        return this.api.get(`/api/v1/number/${numberId}/preferences`).then(getData);
    }
};
