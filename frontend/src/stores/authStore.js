import { ref, computed } from "vue";
import { defineStore } from "pinia";
import { login, logout } from "@/services/HttpService";
import { useRouter } from "vue-router";

export const useAuthStore = defineStore(
  "auth",
  () => {
    const router = useRouter();
    const token = ref("");
    const user = ref({});
    const isAuthenticated = computed(() => token.value !== "");

    async function userLogout() {
      await logout();
      token.value = "";
      user.value = {};

      router.push("/HomeView");
    }

    async function userLogin(data) {
      const response = await login(data);
      if (response.status === 200) {
        alert("Usuário logado com sucesso!");
        token.value = response.data.token;
        user.value = response.data.user;

        router.push("/Dashboard");
      } else {
        alert("Erro ao logar usuário!");
      }
    }

    async function userRegister(data) {
      const response = await register(data);
      if (response.status === 201) {
        alert("Usuário cadastrado com sucesso!");
        token.value = response.data.token;
        user.value = response.data.user;

        router.push("/Dashboard");
      } else {
        alert("Erro ao cadastrar usuário!");
      }
    }

    return {
      token,
      isAuthenticated,
      user,
      userLogout,
      userLogin,
      userRegister,
    };
  },
  {
    persist: {
      enabled: true,
    },
  }
);
