import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import Dashboard from "@/views/Dashboard.vue";
import Profile from "@/views/Profile.vue";
import MyVacancies from "@/views/MyVacancies.vue";


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "home",
      component: HomeView,
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
      path: "/myVacancies",
      name: "myVacancies",
      component: MyVacancies,
    },
  ],
});

export default router;
