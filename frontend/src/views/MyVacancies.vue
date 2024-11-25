<script setup>
import VacancieCard from '@/components/VacancieCard.vue';
import VacancyModal from '@/components/VacancyModal.vue';
import { useAuthStore } from '@/stores/authStore';
import { onMounted, ref, watch } from 'vue';
import { getCandidateApplications, getRecruiterVacancies } from '@/services/HttpService';

const authStore = useAuthStore();
const vacancies = ref([]);

async function getVacancies() {
  vacancies.value = [];

  if (authStore.isRecruiter) {
    const response = await getRecruiterVacancies();
    if (response.status === 200) {
      vacancies.value = response.data;
    }
  }
  else {
    const response = await getCandidateApplications();
    if (response.status === 200) {
      vacancies.value = response.data;
    }
  }
}

function addVacancy(vacancy) {
  vacancies.value.push(vacancy);
}

onMounted(() => {
  getVacancies();
});

watch(
    () => authStore.user.role,
    (newRole) => {
        if (newRole) {
          getVacancies();
        }
    }
);

</script>

<template>
  <main class="mainContainer">
    <div class="vacanciesTitle">
      <h1 v-if="!authStore.isRecruiter">Minhas Vagas</h1>
      <h1 v-if="authStore.isRecruiter" class="vacanciesTitle">Gerenciar Vagas</h1>

      <VacancyModal v-if="authStore.isRecruiter" :addVacancy="addVacancy" />
    </div>

    <div class="vacanciesContainer">
      <VacancieCard v-for="vacancy in vacancies" :key="vacancy.id" :title="vacancy.title" :category="vacancy.category"
        :location="vacancy.location" :description="vacancy.description" />
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

.vacanciesTitle {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 1rem;
  margin-top: 10px;
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
