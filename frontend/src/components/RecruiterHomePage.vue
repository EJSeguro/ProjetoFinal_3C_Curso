<script setup>
import { onMounted, ref } from 'vue';
import { getAllApplications, getApplicationsFromVacancy, getRecruiterVacancies } from '@/services/HttpService';
import RecruiterViewApplicationsCard from './RecruiterViewApplicationsCard.vue';

const allApplications = ref([]);
const vacancies = ref([]);

async function pageInfos() {
    allApplications.value = [];
    vacancies.value = [];

    const responseAllapplications = await getAllApplications();
    if (responseAllapplications.status === 200) {
        allApplications.value = responseAllapplications.data;
    }

    const responseVacancies= await getRecruiterVacancies();
    if (responseVacancies.status === 200) {
        vacancies.value = responseVacancies.data;
    }
}

onMounted(() => {
    pageInfos();
});
</script>

<template>
    <main class="recruiterContainer">
        <div class="recruiterContainer">
            <section class="vacancies">
                <RecruiterViewApplicationsCard v-for="vacancy in vacancies" :key="vacancy.id" :vacancy="vacancy" />
            </section>
        </div>
        </main>
</template>

<style scoped>
main {
    width: 100%;
    height: 100vh;
    font-family: var(--fonte1);
}

.recruiterContainer {
    background-color: var(--roxo);
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    width: 100%;
}

.vacancies {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    flex-wrap: wrap;
    gap: 15px;
}
</style>