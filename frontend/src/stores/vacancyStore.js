import { getRecruiterVacancies as getRecruiterVacanciesApi, getVacancies } from '@/services/HttpService';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useToast } from 'vue-toastification';

export const useVacancyStore = defineStore('vacancyStore', () => {
  const vacancies = ref([]);

  const toast = useToast();

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
    toast.success('Você criou uma vaga com sucesso!',  {
      timeout: 2000
    });
  }

  function deleteVacancy(id) {
    vacancies.value = vacancies.value.filter(vacancy => vacancy.id !== id);
  }

  return { vacancies, getRecruiterVacancies, getAllVacancies, addVacancy, deleteVacancy, getAllVacancies };
});
