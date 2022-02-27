import dashboard from "@/pages/admin/home.vue";
import reports from "@/pages/admin/reports/all.vue";
import centers from "@/pages/admin/centers/all.vue";
import problemes from "@/pages/admin/problems/all.vue";
import About from "@/pages/admin/about.vue";
import categories from "@/pages/admin/categories/all.vue";
export default [
  { path: "/", component: dashboard },
  { path: "reports", component: reports },
  { path: "centers", component: centers },
  { path: "problemes", component: problemes },
  { path: "about", component: About },
  { path: "categories", component: categories },
  { path: "logout", beforeEnter: () => {
    window.location.href = '/';
  }},
];
