<script setup>
import { onMounted, ref } from 'vue';
import { getAllApplications, getApplicationsFromVacancy, getRecruiterVacancies, getRecruiterVacancies } from '@/services/HttpService';

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