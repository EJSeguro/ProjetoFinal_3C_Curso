import { createRouter, createWebHistory } from "vue-router";
import LoginRegister from "../views/LoginRegister.vue";
import Dashboard from "@/views/Dashboard.vue";
import Profile from "@/views/Profile.vue";
import MyVacancies from "@/views/MyVacancies.vue";
import { useAuthStore } from "@/stores/authStore";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "loginRegister",
      component: LoginRegister,
      meta: {
        requiresAuth: false,
      }
    },

    {
      path: "/dashboard",
      name: "dashboard",
      component: Dashboard,
      meta: {
        requiresAuth: true,
      }
    },

    {
      path: "/profile",
      name: "profile",
      component: Profile,
      meta: {
        requiresAuth: true,
      }
    },

    {
      path: "/vacancies",
      name: "vacancies",
      component: MyVacancies,
      meta: {
        requiresAuth: true,
      }
    },
  ],
});

router.beforeEach((to, from, next) => {
  const authStore = useAuthStore();

  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next({ name: "loginRegister" });
  }

  if (!to.meta.requiresAuth && authStore.isAuthenticated) {
    next({ name: "dashboard" });
  }

  next();
});

export default router;
