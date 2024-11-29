import { deleteApplication, getCandidateApplications, storeApplication, getAllApplications as getAllApplicationsApi, getApplicationsFromVacancy as getApplicationsFromVacancyApi } from '@/services/HttpService';
import { defineStore } from 'pinia';
import { ref } from 'vue';
import { useToast } from 'vue-toastification';

const toast = useToast();
export const useApplicationStore = defineStore('applicationStore', () => {
  const applications = ref([]);

  async function applicate(id) {
    try {
      const response = await storeApplication({ vacancy_id: id });
      if (response.status === 200) {
        toast.success('Você se candidatou com sucesso!',  {
          timeout: 2000
        });
      }
    } catch (error) {
      toast.error('Erro ao aplicar!',  {
        timeout: 2000
      });
    }
  }

  async function deapplicate(id) {
    const response = await deleteApplication(id);

    if (response.status === 200) {
      applications.value = applications.value.filter(app => app.id !== id);
      toast.success('Você se descandidatou com sucesso!',  {
        timeout: 2000
      });
    }
  }

  async function getApplications() {
    const response = await getCandidateApplications();
    if (response.status === 200) {
      applications.value = response.data;
    }
  }

  async function getAllApplications() {
    const response = await getAllApplicationsApi();
    if (response.status === 200) {
      applications.value = response.data;
    }
  }
  
  async function getApplicationFromVacancy(id) {
    const response = await getApplicationsFromVacancyApi(id);
    if (response.status === 200) {
      applications.value = response.data;
    }
  }

  return { applications, applicate, getApplications, deapplicate, getAllApplications, getApplicationFromVacancy };
});
