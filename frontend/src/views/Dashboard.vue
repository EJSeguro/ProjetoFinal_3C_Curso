<script setup>

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
  if(!authStore.isRecruiter){
      const response = await getVacancies();
      if (response.status === 200) {
      vacancies.value = response.data;
    }
    }
}
}

onMounted(() => {
getVacancies();
});


</script>

<template>
  <main :class="[!authStore.isRecruiter ? 'candidateContainer' : 'recruiterContainer']">
    <div v-if = "!authStore.isRecruiter" class="candidateContainer">
      
    </div>

    <div v-if = "authStore.isRecruiter" class="recruiterContainer">

    </div>
  </main>
</template>

<style scoped>

main{
  width: 100%;
  height: 100vh;
}
.candidateContainer{
  background-color: var(--azul);
}

.recruiterContainer{
  background-color: var(--roxo);
}
</style>
