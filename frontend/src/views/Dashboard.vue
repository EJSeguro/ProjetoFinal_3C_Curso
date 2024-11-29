<script setup>

import CandidateHomePage from '@/components/CandidateHomePage.vue';
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
    <CandidateHomePage v-if="!authStore.isRecruiter" />
    <RecruiterHomePage v-else />
</template>

<style scoped>

</style>
