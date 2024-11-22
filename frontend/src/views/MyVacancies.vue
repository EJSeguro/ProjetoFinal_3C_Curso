<script setup>
import HeaderPointer from "@/components/HeaderPointer.vue";
// import { myVacancies } from "../stores/vacanciesState"; // Ajuste o caminho para o arquivo correto
</script>

<template>
  <HeaderPointer />
  <main class="mainContainer">
    <h1 class="vacanciesTitle">Minhas Vagas</h1>
    <div class="vacanciesContainer"></div>
  </main>
</template>

<style scoped>
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
}

.mainContainer {
  background-color: rgb(134, 156, 255);
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height: 100vh;
}

.vacanciesTitle {
  margin-left: 40%;
  border-radius: 10px;
  border: 2px solid var(--roxo);
  width: 300px;
  padding: 1%;
  margin-top: 10px;
  background-color: white;
  white-space: nowrap;
}

.vacanciesContainer {
  display: grid;
  margin: 2% 2% 2% 2%;
  gap: 20px;
  flex-wrap: wrap;
  justify-content: center;
  grid-template-columns: 1fr 1fr 1fr;
}
</style>
