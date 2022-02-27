import Vue from "vue";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import App from "./App.vue";
import Router from "vue-router";
import routes from "./router/index";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import store from "./store";
Vue.config.productionTip = false;

Vue.use(Router);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
const router = new Router({
  mode: "history",
  routes, // short for `routes: routes`
});
new Vue({
  router,
  store,
  render: (h) => h(App),
}).$mount("#app");
