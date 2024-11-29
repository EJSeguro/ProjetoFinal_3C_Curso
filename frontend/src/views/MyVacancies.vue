<script setup>
import RecruiterVacancieCard from '@/components/RecruiterVacancieCard.vue';
import CreateEditVacancyModal from '@/components/CreateEditVacancyModal.vue';
import CandidateVacancieCard from '@/components/CandidateVacancieCard.vue';
import { useAuthStore } from '@/stores/authStore';
import { onMounted, ref, watch } from 'vue';
import { getCandidateApplications, getRecruiterVacancies } from '@/services/HttpService';

const authStore = useAuthStore();
const vacancies = ref([]);

function deleteVacancy(id) {
  vacancies.value = vacancies.value.filter(vacancy => vacancy.id !== id);
}

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
    <CreateEditVacancyModal v-if="authStore.isRecruiter" :addVacancy="addVacancy" />
  </div>

    <div v-if="!authStore.isRecruiter" class="vacanciesContainer">
      <CandidateApplicationCard v-for="vacancy in vacancies" :key="vacancy.id" :vacancy="vacancy" />
    </div>

    <div v-else class="vacanciesContainer">
      <RecruiterVacancieCard v-for="vacancy in vacancies" :key="vacancy.id" :vacancy="vacancy" :deleteVacancy="deleteVacancy" />
    </div>
  </main>
</template>

<style scoped>
.mainContainer {
  background-color: var(--azul);
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
