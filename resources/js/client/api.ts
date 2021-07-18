import axios from "axios";

const api = axios.create({ baseURL: "/api" });
api.defaults.withCredentials = true;
api.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default api;