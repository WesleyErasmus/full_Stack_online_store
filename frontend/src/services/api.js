// services/api.js

import axios from "axios";

// Setting my base url
const api = axios.create({
  baseURL: "http://localhost/full_stack_online_store-main/backend/api/",
});

export default api;
