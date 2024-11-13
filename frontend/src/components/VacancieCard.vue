<script></script>

<template>
  <div class="card">
    <img src="" />
    <div class="cardInfos">
      <h3>Vaga 1</h3>
      <p>Categoria</p>
      <p>Área de atuação</p>
      <p>Localidade</p>
      <button>Saiba mais</button>
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
</style>
