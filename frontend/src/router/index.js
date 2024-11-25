import { createRouter, createWebHistory } from "vue-router";
import LoginRegister from "../views/LoginRegister.vue";
import Dashboard from "@/views/Dashboard.vue";
import Profile from "@/views/Profile.vue";
import MyVacancies from "@/views/MyVacancies.vue";


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "loginRegister",
      component: LoginRegister,
    },

    {
      path: "/dashboard",
      name: "dashboard",
      component: Dashboard,
    },

    {
      path: "/profile",
      name: "profile",
      component: Profile,
    },

    {
      path: "/vacancies",
      name: "vacancies",
      component: MyVacancies,
    },
  ],
});

export default router;
