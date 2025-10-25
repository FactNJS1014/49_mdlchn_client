import vuetify, { transformAssetUrls } from "vite-plugin-vuetify";
import tailwindcss from "@tailwindcss/vite";

export default defineNuxtConfig({
  compatibilityDate: "2025-07-15",
  devtools: { enabled: true },

  css: ["~/assets/css/main.css"],

  ssr: false, // รันแบบ SPA

  app: {
    // 👇 ต้องตรงกับ path จริงของคุณใน server
    baseURL: "/49_modelchange/frontend/",
    buildAssetsDir: "_nuxt/", // โฟลเดอร์เก็บ assets
    cdnURL: "", // ต้องว่าง ถ้าใช้ภายใน server
  },

  nitro: {
    preset: "static", // generate เป็น static file
  },

  build: {
    transpile: ["vuetify"],
  },

  modules: [
    // Vuetify plugin
    (_options, nuxt) => {
      nuxt.hooks.hook("vite:extendConfig", (config) => {
        // @ts-expect-error
        config.plugins.push(vuetify({ autoImport: true }));
      });
    },
  ],

  vite: {
    vue: {
      template: { transformAssetUrls },
    },
    plugins: [tailwindcss()],
    define: { "process.env.DEBUG": false },
  },
  runtimeConfig: {
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE,
    },
  },
});
