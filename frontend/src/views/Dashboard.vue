<script setup>

import CandidateVacancieCard from '@/components/CandidateVacancieCard.vue';
import { getAllApplications, getVacancies } from '@/services/HttpService';
import { useAuthStore } from '@/stores/authStore';
import { onMounted, ref } from 'vue';

const authStore = useAuthStore();

const vacancies = ref([]);

async function dashboardInfos() {
  vacancies.value = [];

  if (authStore.isRecruiter) {
    const response = await getAllApplications();
    if (response.status === 200) {
      vacancies.value = response.data;
    }
  }
  else {
    const response = await getVacancies();
    if (response.status === 200) {
      vacancies.value = response.data;
    }
  }
}

onMounted(() => {
  dashboardInfos();
});


</script>

<template>
  <main :class="[!authStore.isRecruiter ? 'candidateContainer' : 'recruiterContainer']">
    <div v-if="!authStore.isRecruiter" class="candidateContainer">
      <div class="vacancies">
      <CandidateVacancieCard v-for="vacancy in vacancies" :key="vacancy.id" :vacancy="vacancy" />
    </div>
    </div>

    <div v-if="authStore.isRecruiter" class="recruiterContainer">

    </div>
  </main>
</template>

<style scoped>
main {
  width: 100%;
  height: 100vh;
}

.candidateContainer {
  background-color: var(--azul);
}

.recruiterContainer {
  background-color: var(--roxo);
}

.vacancies {
display: flex;flex-direction: column;
justify-content: center;
align-items: center;
padding-top: 100px;
}
</style>
