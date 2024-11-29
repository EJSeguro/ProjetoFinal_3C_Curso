<script setup>
import { useAuthStore } from "@/stores/authStore";
import { useProfileStore } from "@/stores/profileStore";
import { Modal } from "bootstrap";
import { onMounted, ref } from "vue";

const authStore = useAuthStore();
const profileStore = useProfileStore();

onMounted(async () => {
  await profileStore.getAcademicBackground(authStore.user.id);
  await profileStore.getProfessionalExperience(authStore.user.id);
});

const modalTitle = ref("");
const modalType = ref("");
const formData = ref({
  title: "",
  institutionOrCompany: "",
  start_date: "",
  end_date: "",
  isEdit: false,
});

const openModal = (type, data = null) => {
  modalType.value = type;
  modalTitle.value = type === "academic" ? "Editar Experiência Acadêmica" : "Editar Experiência Profissional";

  if (data) {
    data.institutionOrCompany = data.institution ? data.institution : data.company;
    formData.value = { ...data, isEdit: true };
  } else {
    formData.value = {
      title: "",
      institutionOrCompany: "",
      start_date: "",
      end_date: null,
    };
  }

  const modal = new Modal(document.getElementById("experienceModal"));
  modal.show();
};

const handleSubmit = () => {
  const modal = Modal.getInstance(document.getElementById("experienceModal"));

  if (formData.value.isEdit) {
    if (modalType.value === "academic") {
      formData.value.institution = formData.value.institutionOrCompany;
      profileStore.updateAcademicBackground(formData.value.id, formData.value);
    }
    else {
      formData.value.company = formData.value.institutionOrCompany;
      profileStore.updateProfessionalExperience(formData.value.id, formData.value);
    }
  } else {
    if (modalType.value === "academic") {
      formData.value.institution = formData.value.institutionOrCompany;
      profileStore.addAcademicExperience(formData.value);
    }
    else {
      formData.value.company = formData.value.institutionOrCompany;
      profileStore.addProfessionalExperience(formData.value);
    }
  }

  modal.hide();
};

</script>

<template>
  <main class="mainContainer">
    <div class="modal fade" id="experienceModal" tabindex="-1" aria-labelledby="experienceModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="experienceModalLabel">{{ modalTitle }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="handleSubmit">
              <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" id="title" v-model="formData.title" class="form-control" required />
              </div>
              <div class="mb-3">
                <label for="institutionOrCompany" class="form-label">
                  {{ modalType === 'academic' ? 'Instituição' : 'Empresa' }}
                </label>
                <input type="text" id="institutionOrCompany" v-model="formData.institutionOrCompany"
                  class="form-control" required />
              </div>
              <div class="mb-3">
                <label for="startDate" class="form-label">Data de Início</label>
                <input type="date" id="startDate" v-model="formData.start_date" class="form-control" required />
              </div>
              <div class="mb-3">
                <label for="endDate" class="form-label">Data de Término</label>
                <input type="date" id="endDate" v-model="formData.end_date" class="form-control" />
              </div>
              <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="profileContainer">
      <!-- <font-awesome-icon id="editIcon" icon="fa-regular fa-pen-to-square" /> -->
      <img class="backgroundImg" src="" />
      <div class="profile">
        <font-awesome-icon id="editProfileInfosIcon" icon="fa-solid fa-user-pen" />
        <img class="profileImg" src="../assets/profile.webp" />
        <div class="profileInfo">
          <h1 class="name">{{ authStore.user.name }}</h1>
          <h2 class="title">{{ authStore.user.title }}</h2>
          <h3 v-if="authStore.user.about" class="about">{{ authStore.user.about }}</h3>
        </div>
      </div>

      <div class="experienceSection">
        <div class="sectionHeader">
          <h2 class="sectionTitle">Experiência Acadêmica</h2>
          <button @click="openModal('academic')" class="addButton">
            <font-awesome-icon icon="fa-solid fa-plus" /> Adicionar
          </button>
        </div>
        <div v-for="academic in profileStore.academicExperience" :key="academic.id" class="experienceItem">
          <div class="experienceContent">
            <h3>{{ academic.title }}</h3>
            <p>{{ academic.institution }}</p>
            <p v-if="academic.end_date">{{ academic.start_date }} -> {{ academic.end_date }}</p>
            <p v-else>{{ academic.start_date }}</p>
          </div>
          <div class="experienceActions">
            <button class="actionButton editButton" @click="openModal('academic', academic)">
              <font-awesome-icon icon="fa-solid fa-edit" />
            </button>
            <div class="deleteButtonWrapper">
              <button data-bs-toggle="dropdown" class="actionButton deleteButton">
                <font-awesome-icon class="trashCan" icon="fa-solid fa-trash-can" />
              </button>
              <div class="dropdown">
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" @click="profileStore.deleteAcademicBackground(academic.id)">Apagar</a>
                  </li>
                  <li><a class="dropdown-item">Cancelar</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="experienceSection">
        <div class="sectionHeader">
          <h2 class="sectionTitle">Experiência Profissional</h2>
          <button @click="openModal('professional')" class="addButton">
            <font-awesome-icon icon="fa-solid fa-plus" /> Adicionar
          </button>
        </div>
        <div v-for="professional in profileStore.professionalExperience" :key="professional.id" class="experienceItem">
          <div class="experienceContent">
            <h3>{{ professional.title }}</h3>
            <p>{{ professional.company }}</p>
            <p v-if="professional.end_date">{{ professional.start_date }} -> {{ professional.end_date }}</p>
            <p v-else>{{ professional.start_date }}</p>
          </div>
          <div class="experienceActions">
            <button class="actionButton editButton" @click="openModal('professional', professional)">
              <font-awesome-icon icon="fa-solid fa-edit" />
            </button>
            <div class="deleteButtonWrapper">
              <button data-bs-toggle="dropdown" class="actionButton deleteButton">
                <font-awesome-icon class="trashCan" icon="fa-solid fa-trash-can" />
              </button>
              <div class="dropdown">
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item"
                      @click="profileStore.deleteProfessionalExperience(professional.id)">Apagar</a></li>
                  <li><a class="dropdown-item">Cancelar</a></li>
                </ul>
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

.confirmDelete,
.cancelDelete {
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