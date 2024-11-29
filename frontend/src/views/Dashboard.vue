<script setup>
import CandidateHomePage from '@/components/CandidateHomePage.vue';
import RecruiterHomePage from '@/components/RecruiterHomePage.vue';
import { useAuthStore } from '@/stores/authStore';
import { useVacancyStore } from '@/stores/vacancyStore';
import { onMounted } from 'vue';

const authStore = useAuthStore();
const vacancyStore = useVacancyStore();

async function dashboardInfos() {
  if (authStore.isRecruiter) {

  }
  else {
    vacancyStore.getAllVacancies();
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
