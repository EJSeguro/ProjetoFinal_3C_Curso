<script setup>
/*import from*/
</script>

<template>
  <div class="home">
    <div class="left-section fontes-esquerda">
      <h1>Bem vindo ao Pointer!</h1>
      <h3>O sistema que aponta ao seu futuro</h3>
      <button>Saiba mais</button>
    </div>
    <div class="right-section"></div>
  </div>
</template>
<style>
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
}

.home {
  height: 100vh;
  width: 100vh;
}

.left-section {
  width: 100%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  background: rgb(0, 183, 255);
  background: linear-gradient(
    160deg,
    rgba(0, 183, 255, 1) 0%,
    rgba(255, 0, 247, 1) 100%
  );
}
.left-section h1 {
  font-size: 3rem;
  font-weight: 800;
  color: var(--branco);
  font-family: var(--fonte1);
  text-shadow: -2px 2px 3px black;
}

.left-section h3 {
  font-size: 1.6rem;
  color: var(--branco);
}

.left-section button {
  background-color: #c668fe;
  margin-top: 5%;
  min-height: 50px;
  min-width: 130px;
  border-radius: 8px;
  border: none;
  font-family: var(--fonte1);
  font-weight: 500;
  font-size: 17px;
  color: white;
}

.left-section button:hover {
  min-width: 180px;
  min-height: 60px;
  font-size: 19px;
  transition-property: min-widht, min-height , font-size;
  transition-duration: 0.5s;
  border: solid 2px white;
}
</style>
