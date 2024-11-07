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
const fileInputBackground = ref(null);

const fileInputProfile = ref(null);
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
        <div class="addInfoButton">
          <button>Adicionar Informações +</button>
        </div>
      </section>
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
  height: 100vh;
  background-color: rgb(184, 184, 184);
  display: flex;
  justify-content: center;
}

.profile {
  background-color: white;
  margin: 3% 10%;
  border-radius: 10px;
  width: 100%;
  display: flex;
  flex-direction: column;
}

.backgroundImage {
  width: 100%;
  height: 200px;
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
  top: -11%;
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

.addInfoButton {
  position: relative;
  display: flex;
}

.addInfoButton button {
  border-radius: 20px;
  width: 16vw;
  height: 5vh;
  border-color: rgb(134, 156, 255);
}
</style>
