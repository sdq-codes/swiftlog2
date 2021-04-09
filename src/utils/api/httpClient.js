import axios from "axios";
import store from "../../store";

const httpClient = axios.create({
       // baseURL: `https://swiftlogapp.herokuapp.com/api/v1/`,
    // baseURL: `http://167.99.152.240/api/v1/`,
    // baseURL: `http://swiftbe.test/api/v1/`,
    baseURL: 'https://oasunilorin.live/public/index.php/api/v1',
    // baseURL: `https://swiftlogist.herokuapp.com/api/v1/`,
    //baseURL: `https://gdlnigeria.herokuapp.com/api/v1/`,
    timeoutErrorMessage: "Request time out",
    headers: {
        "Content-Type": "application/json"
    }
});
httpClient.interceptors.request.use(
    request => {
        store.commit("general/toggleLoading");
        const token = localStorage.getItem("userToken");
        if (token) {
            const token = JSON.parse(localStorage.getItem("userToken"));
            request.headers.Authorization = "Bearer " + token;
        }
        return request;
    },
    error => {
        store.commit("general/toggleLoading");
        return Promise.reject(error);
    }
);

httpClient.interceptors.response.use(
    response => {
        store.commit("general/toggleLoading");
        return response;
    },
    error => {
        store.commit("general/toggleLoading");
        return Promise.reject(error);
    }
);

export default httpClient;
