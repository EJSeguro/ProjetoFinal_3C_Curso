<script setup>
import { RouterView } from "vue-router";
import HeaderPointer from "./components/HeaderPointer.vue";
import { useAuthStore } from "./stores/authStore";

const authStore = useAuthStore();
</script>

<template>
  <HeaderPointer v-if="authStore.isAuthenticated" />
  <RouterView />
</template>

<style>
@import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");

* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
}
</style>
