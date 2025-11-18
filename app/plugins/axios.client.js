import axios from "axios";

export default defineNuxtPlugin(() => {
  const api = axios.create({
    baseURL: "http://172.22.64.11/49_mdlchn_api/",
    withCredentials: true,
  });

  return {
    provide: {
      api,
    },
  };
});
