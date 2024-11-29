import {
  updateProfile as updateProfileApi,
  getProfile as getProfileApi,
  storeAcademicBackground,
  deleteAcademicBackground as deleteAcademicBackgroundApi,
  updateAcademicBackground as updateAcademicBackgroundApi,
  getAcademicBackground as getAcademicBackgroundApi,
  storeExperience,
  updateExperience,
  deleteExperience,
  getExperience,
} from '@/services/HttpService';
import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useProfileStore = defineStore('profileStore', () => {
  const profile = ref({});
  const academicExperience = ref([]);
  const professionalExperience = ref([]);

  const updateProfile = async (profile) => {
    const response = await updateProfileApi(profile);
    if (response.status === 200) {
      profile.value = response.data;
    }
  }

  const getProfile = async () => {
    const response = await getProfileApi();
    if (response.status === 200) {
      profile.value = response.data;
    }
  }

  const addAcademicExperience = async (experience) => {
    const response = await storeAcademicBackground(experience);
    if (response.status === 201) {
      academicExperience.value.push(response.data);
    }
  }

  const updateAcademicBackground = async (id, experience) => {
    const response = await updateAcademicBackgroundApi(id, experience);
    if (response.status === 200) {
      academicExperience.value = academicExperience.value.map(exp => exp.id === id ? experience : exp);
    }
  }

  const deleteAcademicBackground = async (id) => {
    const response = await deleteAcademicBackgroundApi(id);
    if (response.status === 200) {
      academicExperience.value = academicExperience.value.filter(exp => exp.id !== id);
    }
  }

  const getAcademicBackground = async (id) => {
    const response = await getAcademicBackgroundApi(id);
    if (response.status === 200) {
      academicExperience.value = response.data;
    }
  }

  const addProfessionalExperience = async (experience) => {
    const response = await storeExperience(experience);
    if (response.status === 201) {
      professionalExperience.value.push(response.data);
    }
  }

  const updateProfessionalExperience = async (id, experience) => {
    const response = await updateExperience(id, experience);
    if (response.status === 200) {
      professionalExperience.value = professionalExperience.value.map(exp => exp.id === id ? experience : exp);
    }
  }

  const deleteProfessionalExperience = async (id) => {
    const response = await deleteExperience(id);
    if (response.status === 200) {
      professionalExperience.value = professionalExperience.value.filter(exp => exp.id !== id);
    }
  }

  const getProfessionalExperience = async (id) => {
    const response = await getExperience(id);
    if (response.status === 200) {
      professionalExperience.value = response.data;
    }
  }

  return {
    profile,
    academicExperience,
    professionalExperience,
    updateProfile,
    getProfile,
    addAcademicExperience,
    updateAcademicBackground,
    deleteAcademicBackground,
    getAcademicBackground,
    addProfessionalExperience,
    updateProfessionalExperience,
    deleteProfessionalExperience,
    getProfessionalExperience,
  };
});
