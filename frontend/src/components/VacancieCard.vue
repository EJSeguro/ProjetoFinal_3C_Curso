<script setup>
import { ref } from "vue";

const showDescription = ref(false);
</script>

<template>
  <div class="card">
    <img src="" />
    <div class="cardInfos">
      <h3>Vaga:</h3>
      <p>Categoria:</p>
      <p>Área de atuação:</p>
      <p>Localidade:</p>
      <button @click="showDescription = true">Saiba mais</button>
      <div
        v-if="showDescription"
        class="modal"
        @click.self="showDescription = false"
      >
        <div class="modalContent">
          <h3>Descrição da Vaga</h3>
          <p>Aqui você pode colocar a descrição completa da vaga...</p>
          <button @click="showDescription = false">Fechar</button>
          <button @click="apply = true">Candidatar-se</button>
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
  position: absolute;
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
  background: white;
  padding: 20px;
  border-radius: 5px;
  width: 100%;
  height: 100%;
}

.modalContent h3 {
  margin-left: 15%;
}

.modalContent p {
  width: 90%;
}

.modalContent button {
  margin-top: 75px;
  margin-left: 10px;
  width: 150px;
  
}
</style>
