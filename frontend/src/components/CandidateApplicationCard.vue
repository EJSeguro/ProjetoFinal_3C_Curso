<script setup>
import { onMounted, ref } from "vue";
import { getImage } from "@/services/HttpService";

const imageUrl = ref(null);

const props = defineProps({
    vacancy: {
        type: Object,
    },
});

async function getImageUrl() {
    const { data } = await getImage("vacancy", props.vacancy.id);
    imageUrl.value = data.url;
}

onMounted(async () => {
    if (props.vacancy.image) {
        await getImageUrl();
    }
});

const modal = ref(false);

</script>

<template>
  <div class="card">
    <img v-if="props.vacancy.image" :src="imageUrl" />
    <img v-else src="../assets/vacancy.webp" />
    <div class="cardInfosContainer">
    <div class="cardInfos">
      <h3>{{ props.vacancy.title }}</h3>
      <p>{{ props.vacancy.category }} | {{props.vacancy.field }}</p>
      <p>{{ props.vacancy.location }}</p>
    </div>
    <div class="buttonView">
      <button @click="modal = true">Visualizar</button>
    </div>
  </div>
  </div>
  <div v-if="modal" class="modal">
        <div class="modalContent">
          <h3>{{props.title}}</h3>
          <button @click="modal = false">Fechar</button>
          <button>Remover</button>
        </div>
      </div>
</template>

<style scoped>

.cardInfosContainer{
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.card {
  padding: 16px;
  border-radius: 8px;
  background-color: #fff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  height: 250px;
  width: 450px;
  display: flex;
  flex-direction: row;
  gap: 30px;
}

.cardInfos {
  overflow: hidden;
  flex-wrap: nowrap;
}

.buttonView button{
  border-radius: 10px;
  border: none;
  height: 40px;
  width: 200px;
  background-color: var(--roxo);
  color: white;
  font-weight: 550;
}

.card img {
  height: 100%;
  width: 180px;
}

.modal {
  position: fixed;
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
}

.modalContent h3 {
  margin-left: 30%;
}

.modalContent p {
  width: 90%;
}

.modalContent button {      
  border-radius: 15px;
  border: 1px solid var(--roxo);
  height: 40px;
  width: 200px;
  margin-top: 20px;
}

.modalContent button:hover {
  background-color: var(--roxo);
  font-weight: bold;
  color: white;
}
</style>