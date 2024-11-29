<script setup>
import { useAuthStore } from "@/stores/authStore";
import { ref } from "vue";

const authStore = useAuthStore();

const academicExperience = ref([
  { id: 1, institution: 'University A', degree: 'Bachelor of Science', field: 'Computer Science', year: '2018-2022' },
  { id: 2, institution: 'University B', degree: 'Master of Science', field: 'Data Science', year: '2022-2024' },
]);

const professionalExperience = ref([
  { id: 1, company: 'Tech Corp', position: 'Software Developer', period: 'Jan 2022 - Present' },
  { id: 2, company: 'Innovate Inc', position: 'Intern', period: 'Jun 2021 - Dec 2021' },
]);

const deleteConfirmId = ref(null);
const deleteConfirmType = ref('');

const confirmDelete = (type, id) => {
  deleteConfirmId.value = id;
  deleteConfirmType.value = type;
};

const cancelDelete = () => {
  deleteConfirmId.value = null;
  deleteConfirmType.value = '';
};

const deleteExperience = () => {
  const experienceList = deleteConfirmType.value === 'academic' ? academicExperience : professionalExperience;
  experienceList.value = experienceList.value.filter(exp => exp.id !== deleteConfirmId.value);
  cancelDelete();
};

const addExperience = (type) => {
  console.log(`Add ${type} experience`);
};
</script>

<template>
  <main class="mainContainer">
    <div class="profileContainer">
      <font-awesome-icon id="editIcon" icon="fa-regular fa-pen-to-square" />
      <img class="backgroundImg" src="" />
      <div class="profile">
        <font-awesome-icon id="editProfileInfosIcon" icon="fa-solid fa-user-pen" />
        <img class="profileImg" src="../assets/profile.webp" />
        <div class="profileInfo">
          <h1 class="name">{{ authStore.user.name }}</h1>
          <h2 class="title">Título</h2>
          <h3 v-if="authStore.user.about" class="about">{{ authStore.user.about }}</h3>
        </div>
      </div>

      <div class="experienceSection">
        <div class="sectionHeader">
          <h2 class="sectionTitle">Academic Experience</h2>
          <button @click="addExperience('academic')" class="addButton">
            <font-awesome-icon icon="fa-solid fa-plus" /> Add
          </button>
        </div>
        <div v-for="academic in academicExperience" :key="academic.id" class="experienceItem">
          <div class="experienceContent">
            <h3>{{ academic.degree }} in {{ academic.field }}</h3>
            <p>{{ academic.institution }}</p>
            <p>{{ academic.year }}</p>
          </div>
          <div class="experienceActions">
            <button class="actionButton editButton">
              <font-awesome-icon icon="fa-solid fa-edit" />
            </button>
            <div class="deleteButtonWrapper">
              <button @click="confirmDelete('academic', academic.id)" class="actionButton deleteButton">
                <font-awesome-icon icon="fa-solid fa-trash" />
              </button>
              <div v-if="deleteConfirmId === academic.id && deleteConfirmType === 'academic'" class="deleteConfirm">
                <button @click="deleteExperience" class="confirmDelete">Delete</button>
                <button @click="cancelDelete" class="cancelDelete">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="experienceSection">
        <div class="sectionHeader">
          <h2 class="sectionTitle">Professional Experience</h2>
          <button @click="addExperience('professional')" class="addButton">
            <font-awesome-icon icon="fa-solid fa-plus" /> Add
          </button>
        </div>
        <div v-for="professional in professionalExperience" :key="professional.id" class="experienceItem">
          <div class="experienceContent">
            <h3>{{ professional.position }}</h3>
            <p>{{ professional.company }}</p>
            <p>{{ professional.period }}</p>
          </div>
          <div class="experienceActions">
            <button class="actionButton editButton">
              <font-awesome-icon icon="fa-solid fa-edit" />
            </button>
            <div class="deleteButtonWrapper">
              <button @click="confirmDelete('professional', professional.id)" class="actionButton deleteButton">
                <font-awesome-icon icon="fa-solid fa-trash" />
              </button>
              <div v-if="deleteConfirmId === professional.id && deleteConfirmType === 'professional'" class="deleteConfirm">
                <button @click="deleteExperience" class="confirmDelete">Delete</button>
                <button @click="cancelDelete" class="cancelDelete">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<style scoped>
.mainContainer {
  background-color: rgb(134, 156, 255);
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  min-height: 100vh;
}

.profileContainer {
  display: flex;
  margin-top: 50px;
  background-color: white;
  border-radius: 10px;
  flex-direction: column;
  width: 90%;
  height: 100%;
  padding-bottom: 30px;
}

.backgroundImg {
  width: 100%;
  height: 250px;
  background-color: var(--roxo);
  background-size: cover;
  background-position: center;
  border-radius: 10px 10px 0 0;
}

.profile {
  display: flex;
  position: relative;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.profileImg {
  margin-top: -100px;
  width: 220px;
  height: 220px;
  border-radius: 50%;
  border: 5px solid white;
  background-color: gray;
}

.profileInfo {
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 20px;
}

.name {
  font-size: 2rem;
  font-weight: bolder;
}

.title {
  font-size: 1.2rem;
  font-weight: 500;
}

.about {
  font-size: 2rem;
  font-weight: 300;
}

#editIcon {
  position: absolute;
  height: 20px;
  background-color: white;
  border-radius: 50%;
  padding: 8px;
  cursor: pointer;
  right: 7vw;
  top: 16vh;
}

#editProfileInfosIcon {
  position: absolute;
  height: 30px;
  cursor: pointer;
  top: 4vh;
  right: 2vw;
}

.experienceSection {
  margin-top: 30px;
  width: 90%;
  align-self: center;
}

.sectionHeader {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.sectionTitle {
  font-size: 1.5rem;
  font-weight: bold;
  color: var(--roxo);
}

.addButton {
  background-color: var(--roxo);
  color: white;
  border: none;
  border-radius: 5px;
  padding: 5px 10px;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 5px;
}

.experienceItem {
  background-color: #f8f8f8;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 15px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.experienceContent {
  flex-grow: 1;
}

.experienceItem h3 {
  font-size: 1.2rem;
  margin-bottom: 5px;
}

.experienceItem p {
  font-size: 1rem;
  color: #666;
  margin-bottom: 3px;
}

.experienceActions {
  display: flex;
  gap: 5px;
}

.actionButton {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1rem;
  padding: 5px;
  border-radius: 50%;
  transition: background-color 0.3s;
}

.editButton:hover {
  background-color: #e0e0e0;
}

.deleteButton:hover {
  background-color: #ffcccb;
}

.deleteButtonWrapper {
  position: relative;
}

.deleteConfirm {
  position: absolute;
  top: 100%;
  right: 0;
  background-color: white;
  border: 1px solid #ccc;
  border-radius: 4px;
  padding: 5px;
  display: flex;
  flex-direction: column;
  gap: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  z-index: 10;
}

.confirmDelete, .cancelDelete {
  padding: 3px 8px;
  border: none;
  border-radius: 3px;
  cursor: pointer;
  font-size: 0.8rem;
}

.confirmDelete {
  background-color: #dc3545;
  color: white;
}

.cancelDelete {
  background-color: #6c757d;
  color: white;
}
</style>
