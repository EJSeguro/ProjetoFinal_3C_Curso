<script setup>
import { onMounted } from 'vue';
import RecruiterViewApplicationsCard from './RecruiterViewApplicationsCard.vue';
import { useVacancyStore } from '@/stores/vacancyStore';

const vacancieStore = useVacancyStore();

async function pageInfos() {
   vacancieStore.getRecruiterVacancies();
}

onMounted(() => {
    pageInfos();
});
</script>

<template>
    <main class="recruiterContainer">
        <div class="recruiterContainer">
            <section class="vacancies">
                <RecruiterViewApplicationsCard v-for="vacancy in vacancieStore.vacancies" :key="vacancy.id" :vacancy="vacancy" />
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