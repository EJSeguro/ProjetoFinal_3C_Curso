<script setup>
import ChangeFormComponent from "@/components/ChangeFormComponent.vue";
import { useAuthStore } from "@/stores/authStore";
import { ref } from "vue";

const authStore = useAuthStore();

const registerUser = ref({
  name:'',
  email:'',
  password:'',
  password_confirmation:'',
});

const loginUser = ref({
  email:'',
  password:'',
});

const isActive = ref(false);

function changeForm(value) {
  isActive.value = value;
}

async function userLogin() {
  authStore.userLogin(loginUser.value);
}

async function registrateUser() {
  authStore.userRegister(registerUser.value);
}
</script>

<template>
  <div class="home">
    <section class="left-section fontes-esquerda">
      <h1>Bem vindo ao Pointer!</h1>
      <h3>O sistema que aponta ao seu futuro</h3>
      <button>Saiba mais</button>
    </section>
    <section class="right-section">
      <img src="../../public/favicon.ico" />
      <form v-if="isActive" @submit.prevent="userLogin">
        <div class="textoLogin">
          <h2>Olá de novo!</h2>
          <p>Seja bem vindo!</p>
        </div>
        <ChangeFormComponent :changeForm="changeForm" :value="isActive" />
        <input class="inputLogin" type="email" placeholder="Email" v-model="loginUser.email" />
        <input class="inputLogin" type="password" placeholder="Senha" v-model="loginUser.password" />
        <button class="buttonLogin" type="submit">Login</button>
        <div class="opcoes">
          <button>Esqueceu a Senha?</button>
        </div>
      </form>

      <form v-else @submit.prevent="registrateUser">
        <div class="textoLogin">
          <h2>Olá, como você está?</h2>
          <p>Seja bem vindo!</p>
        </div>
        <ChangeFormComponent :changeForm="changeForm" :value="isActive" />

        <input class="inputLogin" type="text" placeholder="Nome Completo" v-model="registerUser.name" />
        <input class="inputLogin" type="email" placeholder="Email" v-model="registerUser.email" />
        <input class="inputLogin" type="password" placeholder="Senha" v-model="registerUser.password" />
        <input class="inputLogin" type="password" placeholder="Confirmar senha" v-model="registerUser.password_confirmation" />
        <button class="buttonLogin" type="submit">Registrar-se</button>
      </form>
    </section>
  </div>
</template>
<style scoped>
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
}

.home {
  height: 100vh;
  display: flex;
}

.left-section {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: rgb(0, 183, 255);
  background: linear-gradient(160deg,
      rgba(0, 183, 255, 1) 0%,
      rgba(255, 0, 247, 1) 100%);
}

.left-section h1 {
  font-size: 3rem;
  font-weight: 800;
  color: var(--branco);
  font-family: var(--fonte1);
  text-shadow: -2px 2px 3px black;
}

.left-section h3 {
  font-size: 1.6rem;
  color: var(--branco);
}

.left-section button {
  background-color: #c668fe;
  margin-top: 5%;
  min-height: 50px;
  min-width: 130px;
  border-radius: 8px;
  border: none;
  font-family: var(--fonte1);
  font-weight: 500;
  font-size: 17px;
  color: white;
}

.left-section button:hover {
  min-width: 180px;
  min-height: 60px;
  font-size: 19px;
  transition-property: min-widht, min-height, font-size;
  transition-duration: 0.5s;
  border: solid 2px white;
}

.right-section {
  width: 100%;
  height: 100%;
  background-color: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-family: var(--fonte1);
}

.right-section form {
  display: flex;
  flex-direction: column;
  width: 60%;
  align-items: center;
  margin-top: 7%;
}

.inputLogin {
  border: solid 2px rgba(155, 155, 155, 0.438);
  color: rgb(155, 155, 155);
  height: 55px;
  border-radius: 20px;
  padding-left: 15px;
  margin-bottom: 15px;
  width: 95%;
}

.textoLogin {
  display: flex;
  flex-direction: column;
  color: black;
  width: 100%;
  margin-bottom: 20px;
}

.textoLogin h2 {
  font-weight: bolder;
}

.textoLogin p {
  font-weight: 500;
}

.buttonLogin {
  width: 95%;
  height: 55px;
  border-radius: 20px;
  border-style: none;
  color: white;
  background-color: var(--roxo);
  font-size: 17px;
  font-weight: bolder;
}

.buttonLogin:hover {
  border: solid 2px black;
}

.opcoes {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  margin-top: 10%;
}

.opcoes button {
  border: none;
  background-color: none;
  color: rgb(87, 87, 87);
  background-color: white;
}

.opcoes button:hover {
  color: var(--roxo);
  text-decoration: underline;
}

.opcoes p {
  padding: 15px;
  color: rgb(141, 141, 141);
}

.right-section img {
  height: 100px;
}

@media (min-width: 0px) and (max-width: 768px) {
  .home {
    flex-direction: column;
  }

  .left-section h1 {
    font-size: 2rem;
  }

  .left-section h3 {
    font-size: 1.2rem;
  }
}
</style>
