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
    </div>
  </main>
</template>

<style scoped>
.mainContainer {
  background-color: rgb(134, 156, 255);
  display: flex;
  flex-direction: column;
  width: 100%;
  min-height: 100vh;
}

.nameContainer {
  margin-left: 37%;
  border-radius: 10px;
  border: 2px solid var(--roxo);
  width: 380px;
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
