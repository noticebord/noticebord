import axios from "axios";

export const api = axios.create({
    baseURL: "/api",
    withCredentials: true,
    headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        "X-Requested-With": "XMLHttpRequest",
    }
});

// api.defaults.withCredentials = true;
// api.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

// export default api;
