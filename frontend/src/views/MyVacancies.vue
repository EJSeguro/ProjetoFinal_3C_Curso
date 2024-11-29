<script setup>
import RecruiterVacancieCard from '@/components/RecruiterVacancieCard.vue';
import CreateEditVacancyModal from '@/components/CreateEditVacancyModal.vue';
import CandidateVacancieCard from '@/components/CandidateVacancieCard.vue';
import { useAuthStore } from '@/stores/authStore';
import { onMounted, ref, watch } from 'vue';
import { getRecruiterVacancies } from '@/services/HttpService';
import { useApplicationStore } from '@/stores/applicationStore';
import { useVacancyStore } from '@/stores/vacancyStore';

const authStore = useAuthStore();
const applicationStore = useApplicationStore();
const vacancyStore = useVacancyStore();

async function getVacanciesAndApplications() {
  if (authStore.isRecruiter) {
   vacancyStore.getVacancies();
  }
  else {
    applicationStore.getApplications();
  }
}

onMounted(() => {
  getVacanciesAndApplications();
});

watch(
    () => authStore.user.role,
    (newRole) => {
        if (newRole) {
          getVacanciesAndApplications();
        }
    }
);
</script>

<template>
  <main class="mainContainer">
    <div class="title">
    <div class="vacanciesTitle">
      <h1 v-if="authStore.isRecruiter" class="vacanciesTitle">Gerenciar Vagas</h1>
      <h1 v-else>Minhas Vagas</h1>
    </div>
    <CreateEditVacancyModal v-if="authStore.isRecruiter" :initialActive="true"/>
  </div>

    <div v-if="!authStore.isRecruiter" class="vacanciesContainer">
      <CandidateVacancieCard v-for="application in applicationStore.applications" :key="application.id" :vacancy="application.vacancy" :application="application" />
    </div>

    <div v-else class="vacanciesContainer">
      <RecruiterVacancieCard v-for="vacancy in vacancyStore.vacancies" :key="vacancy.id" :vacancy="vacancy" />
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
