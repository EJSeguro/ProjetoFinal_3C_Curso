import { ref, computed } from "vue";
import { defineStore } from "pinia";
import { changeRole, login, logout, register } from "@/services/HttpService";
import { useRouter } from "vue-router";
import { useToast } from "vue-toastification";

export const useAuthStore = defineStore(
  "auth",
  () => {
    const router = useRouter();

    const token = ref("");
    const user = ref({});
    const isAuthenticated = computed(() => token.value !== "");
    const isRecruiter = computed(() => user.value.role === "recruiter");

    const toast = useToast();

    async function userLogout() {
      await logout();
      token.value = "";
      user.value = {};
      router.push("/");
    }

    async function userLogin(data) {
      try {
        const response = await login(data);

        if (response.status === 200) {
          toast.success("Usuário logado com sucesso!", {
            timeout: 2000
          });
          token.value = response.data.token;
          user.value = response.data.user;

          router.push("/Dashboard");
        }
      } catch (error) {
        console.error("Erro ao tentar logar:", error);
        alert("Erro ao logar usuário!");
      }
    }

    async function userRegister(data) {
      try {
        const response = await register(data);

        if (response.status === 201) {
          alert("Usuário cadastrado com sucesso!");
          token.value = response.data.token;
          user.value = response.data.user;

          router.push("/Dashboard");
        }
      } catch (error) {
        console.error("Erro ao tentar cadastrar:", error);
        alert("Erro ao cadastrar usuário!");
      }
    }

    async function changeUserRole() {
      const response = await changeRole();
      if (response.status === 200) {
        user.value.role = response.data.role;
      }
    }

    return {
      token,
      isAuthenticated,
      isRecruiter,
      user,
      userLogout,
      userLogin,
      userRegister,
      changeUserRole,
    };
  },
  {
    persist: {
      enabled: true,
    },
  }
);
