// services/api.js

import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost/atlas_api",
});

export default api;
