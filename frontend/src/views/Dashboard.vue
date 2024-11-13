<script setup>
import HeaderPointer from "@/components/HeaderPointer.vue";
import VacancieCard from "@/components/VacancieCard.vue";
</script>

<template>
  <HeaderPointer />
  <main class="mainContainer">
    <h1 class="nameContainer">Vagas Disponíveis</h1>
    <div class="vacanciesContainer">
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
      <VacancieCard />
    </div>
  </main>
</template>

<style scoped>
.mainContainer {
  background-color: rgb(134, 156, 255);
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 100vh;
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
