import BaseMethods from "../BaseMethods";
import getData from "../utils/getData";

export default new class Dashboard extends BaseMethods {
    baseUrl = this.baseUrl + "/dashboard";

    async getGroupedByStatus() {
        return this.api.get(`/api/v1/dashboard/grouped-by-status`).then(getData);
    }
};
