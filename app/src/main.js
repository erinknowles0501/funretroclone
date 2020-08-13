import Vue from "vue";
import VueRouter from "vue-router";
import App from "./App.vue";
import Sprints from "./views/Sprints.vue";
import SprintBoard from "./views/SprintBoard.vue";

Vue.config.productionTip = false;

Vue.use(VueRouter);

const routes = [
  { path: "/sprints", component: Sprints },
  { path: "/sprint/:id", component: SprintBoard },
  // { path: "/", component: App },
];

const router = new VueRouter({
  routes,
});

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");
