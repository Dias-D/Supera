import axios from "axios";
import router from "../router";
import { setGlobalLoading } from "../store/global";
import AuthService from "./auth";
import UsersService from "./users";

const API_ENVS = {
  local: "http://localhost/api",
};

const httpClient = axios.create({
  baseURL: API_ENVS.local,
});

httpClient.interceptors.request.use((config) => {
  setGlobalLoading(true);
  const token = window.localStorage.getItem("token");

  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }

  return config;
});

httpClient.interceptors.response.use(
  (response) => {
    setGlobalLoading(false);

    return response;
  },
  (error) => {
    const canThrowAnError =
      error.response.status === 0 || error.response.status === 500;

    if (canThrowAnError) {
      setGlobalLoading(false);
      throw new Error(error.message);
    }

    if (error.response.status === 401) {
      window.localStorage.removeItem("token");
      router.push({ name: "Home" });
    }

    setGlobalLoading(false);
    return error;
  }
);

export default {
  auth: AuthService(httpClient),
  users: UsersService(httpClient),
};
