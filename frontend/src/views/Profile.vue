<script setup>
import HeaderPointer from "@/components/HeaderPointer.vue";
import { ref } from "vue";

const profileImage = ref("link_da_imagem_de_perfil.jpg");
function triggerUpload(type) {
  // Define o clique do input escondido correspondente
  if (type === "profile") {
    fileInputProfile.value.click();
  } else if (type === "background") {
    fileInputBackground.value.click();
  }
}

function uploadImage(type, event) {
  // Carrega a imagem no componente
  const file = event.target.files[0];
  if (file) {
    const url = URL.createObjectURL(file);
    if (type === "profile") {
      profileImage.value = url;
    } else if (type === "background") {
      backgroundImage.value = url;
    }
  }
}

function updateModal() {
  showModal.value = !showModal.value;
  texts.value.push(modalText.value);
  modalText.value = "";
}

function saveAndClose() {
  showModal2.value = false;
  texts.value.push(modalText.value);
  modalText.value = "";
}

function saveButtonModal3() {
  showModal3.value = false;
  texts.value.push(modalText.value);
  modalText.value = "";
}

const fileInputBackground = ref(null);

const fileInputProfile = ref(null);

const showModal = ref(false);
const showModal2 = ref(false);
const showModal3 = ref(false);

const modalText = ref("");
const texts = ref([]);
</script>

<template>
  <HeaderPointer />
  <div class="mainProfile">
    <div class="profile">
      <div class="backgroundImage">
        <img
          :src="backgroundImage"
          alt="Background Image"
          class="background-image"
        />
        <button
          class="editBackgroundImage"
          @click="triggerUpload('background')"
        >
          <font-awesome-icon
            icon="fa-regular fa-pen-to-square"
            id="iconPencilBackgroundImage"
          />
        </button>
      </div>
      <div class="profileImageDiv" @click="triggerUpload('profile')">
        <font-awesome-icon
          icon="fa-regular fa-pen-to-square"
          id="iconPencilProfileImage"
        />
        <img :src="profileImage" alt="Profile Image" class="profile-image" />
      </div>
      <section class="userProfile">
        <div class="nameProfile">
          <h1>Seu nome</h1>
          <h3>Informações Gerais</h3>
          <select class="selectedRoule" aria-label="Default select example">
            <option value="candidato" selected>Candidato</option>
            <option value="recruiter">Recrutador</option>
          </select>
        </div>
      </section>
      <div class="aboutProfile">
        <div class="aboutText">
          <h1>Sobre</h1>
          <button @click="showModal = true" id="buttonOpenModal">
            <font-awesome-icon icon="fa-solid fa-plus" />
          </button>
          <div v-if="showModal" class="modal">
            <div class="modalContent">
              <h3>Adicionar Informações</h3>
              <textarea
                v-model="modalText"
                id="mensagem"
                rows="4"
                cols="50"
                placeholder="Digite sua mensagem aqui..."
              ></textarea>
              <button @click="updateModal" id="buttonCloseModal">Salvar</button>
            </div>
          </div>
        </div>
        <!-- <div v-for="text in texts" class="exibicaoTexto"> -->
        <!-- <div> -->
        <!-- {{ text }} -->
        <!-- </div> -->
        <!-- </div> -->
      </div>
      <div class="experiencieProfile">
        <div class="experiencieProfileContent">
          <h1>Experiências</h1>
          <button @click="showModal2 = true" id="buttonOpenModal2">
            <font-awesome-icon icon="fa-solid fa-plus" />
          </button>
          <div v-if="showModal2" class="modal">
            <div class="modalContent">
              <h3>Adicionar Informações sobre suas Experiências</h3>
              <div class="divModal">
                <p>Título</p>
                <input
                  class="inputsExperiencie"
                  type="text"
                  placeholder="Nome da empresa"
                />
                <p>Descrição</p>
                <textarea
                  v-model="modalText"
                  id="mensagem"
                  rows="4"
                  cols="50"
                  placeholder="Descreva a sua experiência..."
                ></textarea>
                <p>Data de Ingresso</p>
                <input class="inputsExperiencie" type="date" />
                <p>Data em que saiu</p>
                <input class="inputsExperiencie" type="date" />
                <button @click="saveAndClose">Salvar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="academicTraining">
        <div class="academicTrainingContent">
          <h1 class="noBreak">Formação acadêmica</h1>
          <button @click="showModal3 = true" id="buttonOpenModal3">
            <font-awesome-icon icon="fa-solid fa-plus" />
          </button>
          <div v-if="showModal3" class="modal">
            <div class="modalContent">
              <h3>Adicionar Informações sobre suas Experiências</h3>
              <div class="divModal3">
                <p>Nome da Instituição</p>
                <input
                  class="inputsExperiencie"
                  type="text"
                  placeholder="Digite o nome da instituição"
                />
                <p>Descrição</p>
                <textarea
                  v-model="modalText"
                  id="mensagem"
                  rows="4"
                  cols="50"
                  placeholder="Descreva a sua experiência..."
                ></textarea>
                <p>Data de Ingresso</p>
                <input class="inputsExperiencie" type="date" />
                <p>Data de fim</p>
                <input class="inputsExperiencie" type="date" />
                <button @click="saveButtonModal3">Salvar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <input
    type="file"
    ref="fileInputProfile"
    @change="uploadImage('profile')"
    style="display: none"
  />
  <input
    type="file"
    ref="fileInputBackground"
    @change="uploadImage('background')"
    style="display: none"
  />
</template>

<style scoped>
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
}

.mainProfile {
  height: 100%;
  background-color: rgb(184, 184, 184);
  display: flex;
  justify-content: center;
}

.profile {
  background-color: white;
  margin: 2%;
  border-radius: 10px;
  width: 100%;
  display: flex;
  flex-direction: column;
  height: max-content;
}

.backgroundImage {
  width: 100%;
  height: 250px;
  display: flex;
  background-size: cover;
  background-color: var(--roxo);
  box-shadow: 0px 4px 10px -7px black;
  justify-content: end;
  align-items: flex-end;
  border-radius: 10px 10px 0px 0px;
  position: relative;
}

#iconPencilBackgroundImage {
  height: 90%;
}

.backgroundImage button {
  height: 35px;
  width: 35px;
  border-radius: 50%;
  margin: 0px 2% 2% 0px;
  border: none;
  padding: 4px;
  background-color: rgb(192, 192, 192);
  border: 3px solid white;
}

.editBackgroundImage {
  position: absolute;
  top: 12px;
  background: rgba(255, 255, 255, 0.8);
  border: none;
  padding: 5px;
  border-radius: 4px;
  cursor: pointer;
}

.profileImage {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  cursor: pointer;
  border: 2px solid white;
}

.profileImageDiv {
  position: relative;
  bottom: 7rem;
  left: 5rem;
  border-radius: 50%;
  width: 200px;
  height: 200px;
  background-color: rgb(192, 192, 192);
  border: 4px solid white;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  overflow: hidden;
}

#iconPencilProfileImage {
  position: absolute;
  bottom: 7.2rem;
  left: 5.57rem;
  height: 15%;
}

.userProfile {
  display: flex;
  justify-content: space-between;
  position: relative;
  margin: 0% 8% 0% 8%;
  align-items: center;
}

.nameProfile {
  display: flex;
  flex-direction: column;
  gap: 16px;
  font-family: var(--fonte1);
}

.nameProfile h1 {
  font-size: 30px;
}

.nameProfile h3 {
  font-size: 18px;
  font-weight: 400;
}

.selectedRoule {
  width: 12%;
  min-width: 150px;
  border-radius: 10px;
  height: 40px;
  padding-left: 7px;
  background-color: rgb(134, 156, 255);
  cursor: pointer;
}

.aboutProfile {
  flex-direction: column;
  position: relative;
  font-family: var(--fonte1);
  border-radius: 8px;
  border: 2px solid rgb(134, 156, 255);
  width: 85%;
  margin: 2rem 6rem;
  padding: 20px;
}

.aboutProfile h1 {
  font-size: 30px;
  font-weight: 550;
}

.aboutProfile button {
  padding: 5px;
  margin-left: 80%;
  height: 35px;
  border-radius: 20%;
  border-color: rgb(134, 156, 255);
}

.aboutText {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

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
}

.modalContent {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  width: 600px;
  height: auto;
  text-align: center;
}

.modalContent h3 {
  font-family: var(--fonte1);
  font-size: 20px;
  padding: 1rem;
}

.modalContent button {
  border-radius: 5%;
  margin-top: 1rem;
  width: 6rem;
  margin-left: 75%;
  background-color: rgb(134, 156, 255);
}

.experiencieProfile {
  flex-direction: column;
  position: relative;
  font-family: var(--fonte1);
  border-radius: 8px;
  border: 2px solid rgb(134, 156, 255);
  width: 85%;
  margin: 2rem 6rem;
  padding: 20px;
  height: 80px;
}

.experiencieProfile h1 {
  font-size: 30px;
  font-weight: 550;
}

.experiencieProfile button {
  padding: 5px;
  margin-left: 80%;
  height: 35px;
  border-radius: 20%;
  border-color: rgb(134, 156, 255);
}

.experiencieProfileContent {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.divModal {
  display: flex;
  flex-direction: column;
}

.divModal button {
  border-radius: 5%;
  margin-top: 1rem;
  width: 6rem;
  margin-left: 83%;
  background-color: rgb(134, 156, 255);
}

.academicTraining {
  flex-direction: column;
  position: relative;
  font-family: var(--fonte1);
  border-radius: 8px;
  border: 2px solid rgb(134, 156, 255);
  width: 85%;
  margin: 2rem 6rem;
  padding: 20px;
  height: 80px;
}

.academicTraining h1 {
  font-size: 30px;
  font-weight: 550;
}

.academicTraining button {
  padding: 5px;
  margin-left: 60%;
  height: 35px;
  border-radius: 20%;
  border-color: rgb(134, 156, 255);
}

.academicTrainingContent {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.noBreak {
  white-space: nowrap;
}

.divModal3 {
  display: flex;
  flex-direction: column;
}

.divModal3 button {
  border-radius: 5%;
  margin-top: 1rem;
  width: 6rem;
  margin-left: 83%;
  background-color: rgb(134, 156, 255);
}
</style>
