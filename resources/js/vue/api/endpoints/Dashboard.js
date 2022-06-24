import BaseMethods from "../BaseMethods";
import getData from "../utils/getData";

export default new class Dashboard extends BaseMethods {
    baseUrl = this.baseUrl + "/dashboard";

    async getNumbersGroupedByStatus() {
        return this.api.get(`/api/v1/dashboard/get-numbers-grouped-by-status`).then(getData);
    }
    async getCustomersGroupedByStatus() {
        return this.api.get(`/api/v1/dashboard/get-customers-grouped-by-status`).then(getData);
    }
};
