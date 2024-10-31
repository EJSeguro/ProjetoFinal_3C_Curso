<script setup></script>

<template>
  <div class="home">
    <header>
      <navbar>
        <div class="search">
          <img src="../../public/favicon.ico" />
          <div class="search_bar">
            <input class="searchBar" type="text" placeholder="Pesquise aqui" />
            <font-awesome-icon icon="magnifying-glass" />
          </div>
        </div>
        <div class="navLinks">
          <button>
            <RouterLink to="/dashboard" class="no-underline">
              <font-awesome-icon class="iconsNavLink" icon="house" />
              <li>Início</li>
            </RouterLink>
          </button>
          <button>
            <RouterLink to="/MinhasVagas" class="no-underline">
              <font-awesome-icon
                class="iconsNavLink"
                icon="fa-solid fa-clipboard"
              />
              <li>Minhas Vagas</li>
            </RouterLink>
          </button>
          <button>
            <RouterLink to="/perfil" class="no-underline">
              <font-awesome-icon class="iconsNavLink" icon="fa-solid fa-user" />
              <li>Perfil</li>
            </RouterLink>
          </button>
        </div>
      </navbar>
    </header>
    <main></main>
  </div>
</template>

<style scoped>
* {
  padding: 0%;
  margin: 0%;
  box-sizing: border-box;
}

.no-underline {
  text-decoration: none;
  color: inherit;
}

navbar img {
  height: 50px;
}

.search {
  width: 100%;
  display: flex;
  gap: 2rem;
  align-items: center;
}

.search_bar {
  display: flex;
  justify-content: space-between;
  padding: 0 20px;
  align-items: center;
  border: solid 2px black;
  border-radius: 50px;
}

.search_bar input {
  border: none;
  outline: none;
  font-family: var(--fonte1);
}

.searchBar {
  border: solid 2px rgba(155, 155, 155, 0.438);
  color: rgb(155, 155, 155);
  height: 40px;
  border-radius: 20px;
  padding-left: 15px;
  width: 40%;
  min-width: 200px;
}

navbar {
  display: flex;
  justify-content: space-between;
  margin: 15px 10% 15px 10%;
  align-items: center;
  max-height: 50px;
}

.navLinks {
  display: flex;
  justify-content: space-around;
  list-style-type: none;
  gap: 1rem;
  align-items: center;
  flex-wrap: nowrap;
  width: 40%;
}

.navLinks button:hover {
  font-size: 20px;
  transition: 0.2s;
  color: var(--roxo);
}

.navLinks button:hover .iconsNavLink {
  color: var(--roxo);
}

.navLinks button {
  text-decoration: none;
  color: gray;
  font-weight: 450;
}

.navLinks button {
  display: flex;
  align-items: center;
  flex-direction: column;
}

.iconsNavLink {
  font-size: 1.5rem;
  color: gray;
}

.navLinks button {
  border: none;
  background-color: white;
}

main {
  background-color: rgb(134, 156, 255);
  height: 100vh;
  width: 100vw;
}
</style>
