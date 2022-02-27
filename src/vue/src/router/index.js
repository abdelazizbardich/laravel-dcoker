import store from "../store"
// public
import publicApp from "@/pages/public/App.vue";
import publicRoutes from "@/router/public/index.js";

// Admin
import adminApp from "@/pages/admin/App.vue";
import adminRoutes from "@/router/admin/index.js";
import AdminLogin from "@/pages/admin/login.vue"; // login

// institution
import institutionApp from "@/pages/institution/App.vue";
import institutionRoutes from "@/router/institution/index.js";
import InstitutionLogin from "@/pages/institution/login.vue"; // login

export default [
  // public
  { path: "/", component: publicApp, children: publicRoutes },

  // admin
  { path: "/admin", component: adminApp, children: adminRoutes,
    beforeEnter: (to,from,next) => {
      if(store.getters.getUserData == null){
        next("/admin/login");
      }else{
        next()
      }
    } 
  },
  { path: "/admin/login", component: AdminLogin },

  // institutions
  { path: "/institution", component: institutionApp, children: institutionRoutes },
  { path: "/institution/login", component: InstitutionLogin }
];
