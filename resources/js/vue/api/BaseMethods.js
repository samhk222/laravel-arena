import getData from "./utils/getData";
import BaseConfigs from "./BaseConfigs";

export default class BaseMethods extends BaseConfigs {
    baseUrl = '/api/v1';

    async index(params) {
        return this.api.get(this.baseUrl, {params});
    }

    async paginated(page=1, params){
        return this.api.get(`${this.baseUrl}?page=${page}`, {params});
    }

    async get(id) {
        return this.api.get(`${this.baseUrl}/${id}`).then(getData);
    }

    async store(data) {
        return this.api.post(this.baseUrl, data).then(getData);
    }

    async show(id, params) {
        const url = this.baseUrl + "/" + id;

        return this.api.get(url, {params}).then(getData);
    }

    async update(id, data) {
        const url = this.baseUrl + "/" + id;

        return this.api.put(url, data).then(getData);
    }

    async destroy(id) {
        const url = this.baseUrl + "/" + id;

        return this.api.delete(url).then(getData);
    }
}
