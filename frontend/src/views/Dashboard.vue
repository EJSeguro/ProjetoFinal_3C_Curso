<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faMagnifyingGlass } from "@fortawesome/free-solid-svg-icons";
import { library } from "@fortawesome/fontawesome-svg-core";

library.add(faMagnifyingGlass);

export default {
  components: {
    FontAwesomeIcon,
  },
  name: "Dashboard",
};
</script>

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
          <div>
            <li><RouterLink to="/dashboard">Início</RouterLink></li>
          </div>
          <div>
            <li><RouterLink to="/MinhasVagas">Minhas Vagas</RouterLink></li>
          </div>
          <div>
            <li><RouterLink to="/perfil">Perfil</RouterLink></li>
          </div>
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
  margin: 15px 5% 15px 5%;
  align-items: center;
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

.navLinks li a {
  text-decoration: none;
  color: black;
}

main {
  background-color: rgb(134, 156, 255);
  height: 100vh;
  width: 100vw;
}
</style>
