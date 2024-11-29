import { getRecruiterVacancies as getRecruiterVacanciesApi, getVacancies } from '@/services/HttpService';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useVacancyStore = defineStore('vacancyStore', () => {
  const vacancies = ref([]);

  async function getRecruiterVacancies() {
    const response = await getRecruiterVacanciesApi();
    if (response.status === 200) {
      vacancies.value = response.data;
    }
  }

  async function getAllVacancies() {
    const response = await getVacancies();
    if (response.status === 200) {
      vacancies.value = response.data;
    }
  }

  function addVacancy(vacancy) {
    vacancies.value.push(vacancy);
  }

  function deleteVacancy(id) {
    vacancies.value = vacancies.value.filter(vacancy => vacancy.id !== id);
  }

  return { vacancies, getRecruiterVacancies, getAllVacancies, addVacancy, deleteVacancy, getAllVacancies };
});
