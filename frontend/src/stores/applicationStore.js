import { deleteApplication, getCandidateApplications, storeApplication } from '@/services/HttpService';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useApplicationStore = defineStore('applicationStore', () => {
  const applications = ref([]);

  async function applicate(id) {
    try {
      const response = await storeApplication({ vacancy_id: id });
      if (response.status === 200) {
        alert('Você se candidatou com sucesso!');
      }
    } catch (error) {
      alert('Erro ao aplicar!');
    }
  }

  async function deapplicate(id) {
    const response = await deleteApplication(id);

    if (response.status === 200) {
      applications.value = applications.value.filter(app => app.id !== id);
      alert('Você se descandidatou com sucesso!');
    }
  }

  async function getApplications() {
    const response = await getCandidateApplications();
    if (response.status === 200) {
      applications.value = response.data;
    }
  }

  return { applications, applicate, getApplications, deapplicate };
});
