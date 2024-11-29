import { getRecruiterVacancies } from '@/services/HttpService';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useVacancyStore = defineStore('vacancyStore', () => {
  const vacancies = ref([]);

  async function getVacancies() {
    const response = await getRecruiterVacancies();
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

  return { vacancies, getVacancies, addVacancy, deleteVacancy };
});
