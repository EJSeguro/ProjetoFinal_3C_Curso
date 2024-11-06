<script setup>
import HeaderPointer from "@/components/HeaderPointer.vue";
</script>

<template>
  <HeaderPointer />
  <div class="mainProfile">
    <div class="profile">
      <div class="backgroundImage">
        <button>
          <font-awesome-icon
            icon="fa-regular fa-pen-to-square"
            id="iconPencilBackgroundImage"
          />
        </button>
      </div>
      <div class="profileImageDiv">
        <input type="file" class="profileImage" />
        <font-awesome-icon
          icon="fa-regular fa-pen-to-square"
          id="iconPencilProfileImage"
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
}

.mainProfile {
  height: 100vh;
  background-color: rgb(134, 156, 255);
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
}

#iconPencilProfileImage {
  position: relative;
  bottom: 7.2rem;
  left: 5.57rem;
  height: 15%;
}
</style>
