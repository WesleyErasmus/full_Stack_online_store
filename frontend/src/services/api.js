// services/api.js

import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost/full_stack_online_store/backend/",
});

export default api;
