// import this after install `@mdi/font` package
// import "@fortawesome/fontawesome-free/css/all.css";
import "@mdi/font/css/materialdesignicons.css";

import "vuetify/styles";
import { createVuetify } from "vuetify";
import { md1 } from "vuetify/blueprints";
import { aliases, fa } from "vuetify/iconsets/fa";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

export default defineNuxtPlugin((app) => {
  const vuetify = createVuetify({
    components,
    directives,
    ssr: true,
    blueprint: md1,
    icons: {
      defaultSet: "mdi", // This is already the default value - only for display purposes
    },
  });
  app.vueApp.use(vuetify);
});
