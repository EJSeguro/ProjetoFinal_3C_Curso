<script setup>
import { RouterView } from "vue-router";
import HeaderComponent from "./components/HeaderComponent.vue";
import { useAuthStore } from "./stores/authStore";

const authStore = useAuthStore();
</script>

<template>
  <div>
    <HeaderComponent v-if="authStore.isAuthenticated" />
    <RouterView />
  </div>
</template>

<style>
@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}
</style>
