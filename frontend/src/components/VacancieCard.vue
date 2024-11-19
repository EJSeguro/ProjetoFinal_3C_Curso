<script setup>
import { ref } from "vue";

const showModal = ref(false);

function closeModal() {
  showModal.value = false;
}
</script>

<template>
  <div class="card">
    <img src="" />
    <div class="cardInfos">
      <h3>Vaga:</h3>
      <p>Categoria:</p>
      <p>Área de atuação:</p>
      <p>Localidade:</p>
      <button @click="showModal = true">Saiba mais</button>
      <div v-if="showModal" class="modal">
        <div class="modalContent">
          <h3>Detalhes da Vaga</h3>
          <p></p>
          <button @click="closeModal">Fechar</button>
          <button @click="">Candidatar-se</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.card {
  padding: 16px;
  border: 1px solid #ccc;
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
  width: 70%;
  height: 100%;
  flex-wrap: nowrap;
}

.cardInfos button {
  border-radius: 15px;
  border: 1px solid var(--roxo);
  height: 40px;
  width: 200px;
}

.cardInfos button:hover {
  background-color: var(--roxo);
  font-weight: bold;
  color: white;
}

.card img {
  height: 100%;
  width: 100%;
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
  margin-top: 75px;
  margin-left: 90px;
  width: 150px;
}
</style>
