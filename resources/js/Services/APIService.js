import axios from "axios";

export default class APIService {
    getData(endpoint, queryParams) {
        let response = axios.get(endpoint, { params: queryParams })
        return response
    }
}
