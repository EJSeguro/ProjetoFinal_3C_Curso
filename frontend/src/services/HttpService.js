import axios from 'axios';
import { useAuthStore } from '@/stores/authStore';

const authHeader = () => {
    const authStore = useAuthStore();
    return { Authorization: `Bearer ${authStore.token}` };
};

const httpService = axios.create({
    baseURL: 'http://localhost:8001/api/',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

export const login = async (user) => {
    return await httpService.post('login', user);
}

export const register = async (user) => {
    return await httpService.post('register', user);
}

export const logout = async () => {
    return await httpService.post('logout', {}, { headers: authHeader() });
};

export const getProfile = async () => {
    return await httpService.get('profile', { headers: authHeader() });
};

export const updateProfile = async (profile) => {
    return await httpService.put('profile', profile, { headers: authHeader() });
};

export const deleteProfile = async () => {
    return await httpService.delete('profile', { headers: authHeader() });
};

export const changeRole = async () => {
    return await httpService.put('changeRole', {}, { headers: authHeader() });
};

export const storeApplication = async (application) => {
    return await httpService.post('candidate/application', application, { headers: authHeader() });
};

export const deleteApplication = async (id) => {
    return await httpService.delete(`candidate/application/${id}`, { headers: authHeader() });
};

export const getCandidateApplications = async () => {
    return await httpService.get('candidate/applications', { headers: authHeader() });
};

export const storeAcademicBackground = async (data) => {
    return await httpService.post('academicBackground', data, { headers: authHeader() });
};

export const updateAcademicBackground = async (id, data) => {
    return await httpService.put(`academicBackground/${id}`, data, { headers: authHeader() });
};

export const deleteAcademicBackground = async (id) => {
    return await httpService.delete(`academicBackground/${id}`, { headers: authHeader() });
};

export const getAcademicBackground = async (id) => {
    return await httpService.get(`academicBackground/${id}`, { headers: authHeader() });
};

export const storeExperience = async (data) => {
    return await httpService.post('experience', data, { headers: authHeader() });
};

export const updateExperience = async (id, data) => {
    return await httpService.put(`experience/${id}`, data, { headers: authHeader() });
};

export const deleteExperience = async (id) => {
    return await httpService.delete(`experience/${id}`, { headers: authHeader() });
};

export const getExperience = async (id) => {
    return await httpService.get(`experience/${id}`, { headers: authHeader() });
};

export const storeVacancy = async (data) => {
    return await httpService.post('recruiter/vacancy', data, { headers: authHeader() });
};

export const updateVacancy = async (id, data) => {
    return await httpService.put(`recruiter/vacancy/${id}`, data, { headers: authHeader() });
};

export const deleteVacancy = async (id) => {
    return await httpService.delete(`recruiter/vacancy/${id}`, { headers: authHeader() });
};

export const getAllApplications = async () => {
    return await httpService.get('recruiter/applications', { headers: authHeader() });
};

export const getApplicationsFromVacancy = async (id) => {
    return await httpService.get(`recruiter/applications/${id}`, { headers: authHeader() });
};

export const getVacancies = async () => {
    return await httpService.get('vacancies', { headers: authHeader() });
};

export const getVacancyById = async (id) => {
    return await httpService.get(`vacancy/${id}`, { headers: authHeader() });
};

export const getRecruiterVacancies = async () => {
    return await httpService.get('recruiter/vacancies', { headers: authHeader() });
};

export const uploadImage = async (data) => {
    let headers = authHeader();
    headers["Content-Type"] = "multipart/form-data";
    
    return await httpService.post('uploadImage', data, { headers: headers });
};

export const getImage = async (type, id) => {
    return await httpService.get(`images/${type}/${id}`, { headers: authHeader() });
};