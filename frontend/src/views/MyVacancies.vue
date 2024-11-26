<script setup>
import VacancieCard from '@/components/RecruiterVacancieCard.vue';
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
    <div class="title">
    <div class="vacanciesTitle">
      <h1 v-if="!authStore.isRecruiter">Minhas Vagas</h1>
      <h1 v-if="authStore.isRecruiter" class="vacanciesTitle">Gerenciar Vagas</h1>
    </div>
    <VacancyModal v-if="authStore.isRecruiter" :addVacancy="addVacancy" />
  </div>

    <div class="vacanciesContainer">
      <VacancieCard v-for="vacancy in vacancies" :key="vacancy.id" :vacancy="vacancy" />
    </div>
  </main>
</template>

<style scoped>
.mainContainer {
  background-color: rgb(134, 156, 255);
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center; 
  width: 100%;
  min-height: 100vh;
}


.vacanciesContainer {
display: flex;
flex-wrap: wrap;
gap: 20px;
justify-content: center;
}

.title{
  display: flex;
  align-items: center;
  margin-top: 20px;
  gap: 25px;
  margin-bottom: 20px;
  width: 100%;
  padding-left: 2% ;
  padding-right: 2%;
  margin-top: 4%;
  margin-bottom: 2%;
}
</style>
