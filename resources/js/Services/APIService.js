import axios from "axios";

export default class APIService {
    getData(endpoint, queryParams) {
        return axios.get(endpoint, { params: queryParams })
            .then(res => res.data);
    }
}
