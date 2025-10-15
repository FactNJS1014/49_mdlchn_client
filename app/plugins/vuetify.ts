// import this after install `@mdi/font` package
import "@fortawesome/fontawesome-free/css/all.css";

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
      defaultSet: "fa",
      aliases,
      sets: {
        fa,
      },
    },
  });
  app.vueApp.use(vuetify);
});
