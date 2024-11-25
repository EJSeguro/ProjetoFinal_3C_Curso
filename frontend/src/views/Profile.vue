<script setup>
import HeaderPointer from "@/components/HeaderPointer.vue";
import Modal from "@/components/Modal.vue";
import { useAuthStore } from "@/stores/authStore";
import { ref, reactive } from "vue";

const authStore = useAuthStore();

// Estado reativo para imagens e modais
const state = reactive({
  images: {
    profile: "link_da_imagem_de_perfil.jpg",
    background: "",
  },
  modals: {
    about: false,
    experience: false,
    education: false,
  },
  modalText: "",
  texts: [],
  role: "candidato",
});

const fileInputs = {
  profile: ref(null),
  background: ref(null),
};

// Função genérica para abrir input de arquivo
const triggerUpload = (type) => fileInputs[type]?.value?.click();

// Função genérica para upload de imagem
const uploadImage = (type, event) => {
  const file = event.target.files[0];
  if (file) state.images[type] = URL.createObjectURL(file);
};

// Controle de modais
const toggleModal = (modal) => (state.modals[modal] = !state.modals[modal]);

const saveModalData = (modal) => {
  state.texts.push(state.modalText);
  state.modalText = "";
  toggleModal(modal);
};

// Funções de recrutador
const handleRecruiterAction = (action) => alert(action);
</script>

<template>
  <HeaderPointer />
  <div class="mainProfile">
    <div class="profile">
      <!-- Background Image -->
      <div class="backgroundImage">
        <img :src="state.images.background" alt="Background Image" class="background-image" />
        <button class="editBackgroundImage" @click="triggerUpload('background')">
          <font-awesome-icon icon="fa-regular fa-pen-to-square" />
        </button>
      </div>

      <!-- Profile Image -->
      <div class="profileImageDiv" @click="triggerUpload('profile')">
        <font-awesome-icon icon="fa-regular fa-pen-to-square" />
        <img :src="state.images.profile" alt="Profile Image" class="profile-image" />
      </div>

      <!-- User Role -->
      <section class="userProfile">
        <div class="nameProfile">
          <h1>Seu nome</h1>
          <h3>Informações Gerais</h3>
          <select v-model="state.role" class="selectedRole">
            <option value="candidato">Candidato</option>
            <option value="recruiter">Recrutador</option>
          </select>
          <div v-if="state.role === 'recruiter'" class="recrutador-options">
            <h2>Opções de Recrutador</h2>
            <button @click="handleRecruiterAction('Criar Vaga')">Criar Vaga</button>
            <button @click="handleRecruiterAction('Editar Vaga')">Editar Vaga</button>
          </div>
        </div>
      </section>

      <!-- Modais genéricos -->
      <div class="aboutProfile">
        <div class="aboutText">
          <h1>Sobre</h1>
          <button @click="toggleModal('about')"><font-awesome-icon icon="fa-solid fa-plus" /></button>
          <Modal v-if="state.modals.about" title="Adicionar Informações" @close="saveModalData('about')">
            <textarea v-model="state.modalText" placeholder="Digite sua mensagem aqui..."></textarea>
          </Modal>
        </div>
      </div>

      <div class="experiencieProfile">
        <div class="experiencieProfileContent">
          <h1>Experiências</h1>
          <button @click="toggleModal('experience')"><font-awesome-icon icon="fa-solid fa-plus" /></button>
          <Modal v-if="state.modals.experience" title="Adicionar Experiências" @close="saveModalData('experience')">
            <p>Título</p>
            <input type="text" placeholder="Nome da empresa" />
            <p>Descrição</p>
            <textarea v-model="state.modalText" placeholder="Descreva sua experiência..."></textarea>
          </Modal>
        </div>
      </div>

      <div class="academicTraining">
        <div class="academicTrainingContent">
          <h1 class="noBreak">Formação acadêmica</h1>
          <button @click="toggleModal('education')"><font-awesome-icon icon="fa-solid fa-plus" /></button>
          <Modal v-if="state.modals.education" title="Adicionar Formação Acadêmica" @close="saveModalData('education')">
            <p>Nome da Instituição</p>
            <input type="text" placeholder="Digite o nome da instituição" />
            <p>Descrição</p>
            <textarea v-model="state.modalText" placeholder="Descreva sua formação..."></textarea>
          </Modal>
        </div>
      </div>
    </div>
  </div>

  <!-- Hidden file inputs -->
  <input type="file" ref="fileInputs.profile" @change="(e) => uploadImage('profile', e)" style="display: none" />
  <input type="file" ref="fileInputs.background" @change="(e) => uploadImage('background', e)" style="display: none" />
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.mainProfile {
  height: 100%;
  background-color: rgb(184, 184, 184);
  display: flex;
  justify-content: center;
  padding: 20px;
}

.profile {
  background-color: white;
  border-radius: 10px;
  width: 100%;
  max-width: 1200px;
  display: flex;
  flex-direction: column;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  overflow: hidden;
}

/* Background Image Section */
.backgroundImage {
  position: relative;
  width: 100%;
  height: 250px;
  background-size: cover;
  background-color: var(--roxo);
  display: flex;
  justify-content: flex-end;
  align-items: flex-end;
}

.backgroundImage img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 10px 10px 0 0;
}

.editBackgroundImage {
  position: absolute;
  top: 10px;
  right: 10px;
  background: rgba(255, 255, 255, 0.8);
  border: none;
  padding: 5px;
  border-radius: 4px;
  cursor: pointer;
}

/* Profile Image Section */
.profileImageDiv {
  position: relative;
  margin: -100px auto 20px;
  width: 200px;
  height: 200px;
  background-color: rgb(192, 192, 192);
  border-radius: 50%;
  border: 4px solid white;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  cursor: pointer;
}

.profileImageDiv img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  object-fit: cover;
}

/* User Profile Section */
.userProfile {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
  margin: 20px 0;
}

.nameProfile h1 {
  font-size: 30px;
  font-weight: bold;
  text-align: center;
}

.nameProfile h3 {
  font-size: 18px;
  font-weight: normal;
  text-align: center;
  color: gray;
}

.selectedRole {
  width: 200px;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid rgb(134, 156, 255);
  background-color: rgb(240, 240, 255);
  cursor: pointer;
}

.recrutador-options button {
  margin: 5px;
  padding: 10px 20px;
  background-color: #008cba;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.recrutador-options button:hover {
  background-color: #007bb5;
}

/* Section Styles */
.aboutProfile,
.experiencieProfile,
.academicTraining {
  margin: 20px auto;
  padding: 20px;
  width: 85%;
  max-width: 800px;
  border: 2px solid rgb(134, 156, 255);
  border-radius: 8px;
  background-color: white;
}

.aboutProfile h1,
.experiencieProfile h1,
.academicTraining h1 {
  font-size: 24px;
  font-weight: bold;
}

.aboutProfile button,
.experiencieProfile button,
.academicTraining button {
  float: right;
  padding: 5px 10px;
  background-color: rgb(134, 156, 255);
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.aboutProfile button:hover,
.experiencieProfile button:hover,
.academicTraining button:hover {
  background-color: rgb(114, 136, 235);
}

/* Modal Styles */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modalContent {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  width: 400px;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
  text-align: center;
}

.modalContent h3 {
  font-size: 20px;
  margin-bottom: 10px;
}

.modalContent textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid rgb(200, 200, 200);
  border-radius: 5px;
  resize: none;
  margin-bottom: 10px;
}

.modalContent button {
  margin-top: 10px;
  padding: 10px 20px;
  background-color: rgb(134, 156, 255);
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.modalContent button:hover {
  background-color: rgb(114, 136, 235);
}
</style>
