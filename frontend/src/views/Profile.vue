<script setup>
import HeaderPointer from "@/components/HeaderPointer.vue";
import { useAuthStore } from "@/stores/authStore";

const authStore = useAuthStore();
</script>

<template>
  <HeaderPointer />
  <main class="mainContainer">
    <div class="profileContainer">
      <font-awesome-icon id="editIcon" icon="fa-regular fa-pen-to-square" />
      <img class="backgroundImg" src="" />
      <div class="profile">
        <font-awesome-icon id="editProfileInfosIcon" icon="fa-solid fa-user-pen" />
        <img class="profileImg" />
          <div class="profileInfo">
            <h1 class="name">{{ authStore.user.name }}</h1>
            <h2 class="title">Título</h2>
            <h3 v-if="authStore.user.about" class="about">{{ authStore.user.about }}</h3>
          </div>
        </div>
    </div>
  </main>
</template>

<style scoped>
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
}

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
  position: absolute;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  position: relative;

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
</style>