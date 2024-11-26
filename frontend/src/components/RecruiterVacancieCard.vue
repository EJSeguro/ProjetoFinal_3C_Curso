<script setup>
import { ref, watch } from "vue";
import VacancyModal from "./VacancyModal.vue";

const props = defineProps({
  vacancy: {
    type: Object,
    required: true
  }
});

const localVacancy = ref({ ...props.vacancy });

function updateVacancy(updatedVacancy) {
  localVacancy.value = updatedVacancy;
}

</script>

<template>
  <div class="card">
    <img :src="localVacancy.image" />
    <div class="cardInfos">
      <h3>{{ localVacancy.title }}</h3>
      <p>{{ localVacancy.category }}</p>
      <p>{{ localVacancy.location }}</p>
      <p>{{ localVacancy.description }}</p>
      <div>
      <VacancyModal :initialTitle="props.vacancy.title" :initialDescription="props.vacancy.description"
        :initialCategory="props.vacancy.category" :initializeImage="props.vacancy.image"
        :initialField="props.vacancy.field" :initialLocation="props.vacancy.location"
        :initialActive="props.vacancy.active" :id="props.vacancy.id" :updateVacancy="updateVacancy" isEdit="true" />
        <font-awesome-icon class="trashCan" icon="fa-solid fa-trash-can" />
      </div>
    </div>
  </div>

</template>

<style scoped>

.card {
  padding: 16px;
  border-radius: 8px;
  background-color: #fff;
  height: 250px;
  width: 450px;
  display: flex;
  flex-direction: row;
  gap: 30px;
}

.cardInfos {
  width: 70%;
  height: 100%;
  flex-wrap: nowrap;
}

.cardInfos button {
  border-radius: 15px;
  border: 1px solid var(--roxo);
  height: 40px;
  width: 200px;
}

.cardInfos button:hover {
  background-color: var(--roxo);
  font-weight: bold;
  color: white;
}

.card img {
  height: 100%;
  width: 150px;
}

.trashCan {
  position: absolute;
  right: 20px;
  bottom:40px;
  color: red;
  font-size: 25px;
  cursor: pointer;
}
</style>
