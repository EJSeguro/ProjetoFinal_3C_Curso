<script setup>
import { ref } from 'vue';
import CandidateVacancieCard from './CandidateVacancieCard.vue';
import { useVacancyStore } from '@/stores/vacancyStore';
import { useApplicationStore } from '@/stores/applicationStore';

const vacancyStore = useVacancyStore();
const applicationStore = useApplicationStore();

const vacancySelected = ref(null);

</script>

<template>
    <main class="candidateContainer">
        <div class="candidateContainer">
            <div class="allVacancies">
                <div class="title">
                    <h1>Vagas Disponíveis</h1>
                </div>
                <div class="vacanciesDescription">
                    <div class="vacancies">
                        <CandidateVacancieCard v-for="vacancy in vacancyStore.vacancies" :key="vacancy.id"
                            :vacancy="vacancy" @click="vacancySelected = vacancy" />
                    </div>
                   
                    <div class="vacanciesApplication" v-if="vacancySelected">
                        <div class="vacanciesInfos vacanciesInfosSelected">
                            <div class="infos">
                                <h2>{{ vacancySelected.title }}</h2>
                                <h5>{{ vacancySelected.field }} | {{ vacancySelected.category }}</h5>
                                <h5>{{ vacancySelected.location }}</h5>
                                <p>{{ vacancySelected.description }}</p>
                            </div>
                        </div>
                        <div class="applicationButton">
                            <button @click="applicationStore.applicate(vacancySelected.id)">Candidatar-se</button>
                        </div>
                    </div>
                   
                    <div class="vacanciesApplication" v-else>
                        <div class="vacanciesInfos">
                            <div class="infos">
                                <h2>Título da Vaga</h2>
                                <h5>Área | Categoria</h5>
                                <h5>Localidade</h5>
                                <p>Descrição</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<style scoped>
main {
    width: 100%;
    height: 100vh;
    font-family: var(--fonte1);
}

.allVacancies {
    width: 70%;
    height: 100%;
}

.title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: white;
    width: 100%;
    height: 80px;
    padding: 1%;
    border: rgba(128, 128, 128, 0.295) 2px solid;
    box-shadow: inset 0 10px 12px rgba(0, 0, 0, 0.1);
}

.vacanciesDescription {
    display: flex;
    justify-content: center;
    height: 100vh;
    width: 100%;
}

.candidateContainer {
    background-color: var(--azul);
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
    width: 100%;
}

.recruiterContainer {
    background-color: var(--roxo);
}

.vacancies {
    scroll-behavior: auto;
    display: flex;
    flex-direction: column;
    background-color: white;
    width: 100%;
    max-height: 100vh;
    border-right: rgba(128, 128, 128, 0.295) 2px solid;
    overflow: auto;

}

.vacanciesApplication {
    scroll-behavior: auto;
    max-height: 100vh;
    width: 100%;
    background-color: white;
    overflow: auto;
    flex-wrap: wrap;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.applicationButton {
    height: 100px;
    display: flex;
    padding: 2%;
    justify-content: center;
    align-items: center;
}

.applicationButton button {
    background-color: var(--roxo);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    height: 80%;
    width: 80%;
}

.infos {
    display: flex;
    flex-direction: column;
    height: 85%;
    width: 100%;
}

.vacanciesInfos {
    display: flex;
    flex-direction: column;
    width: 100%;
    padding: 6%;
}

.vacanciesInfosSelected {
    height: 88%;
    box-shadow: inset 0 -4px 6px rgba(0, 0, 0, 0.2);
}
</style>