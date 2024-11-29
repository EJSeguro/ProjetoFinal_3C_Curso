<script setup>
import { useAuthStore } from '@/stores/authStore';

const authStore = useAuthStore();


async function changeColor() {
  const root = document.documentElement;

  if (!authStore.isRecruiter) {
    const roxo = getComputedStyle(root).getPropertyValue('--roxo').trim();
    root.style.setProperty('--backgroundColor', roxo);
  } else {
    const azul = getComputedStyle(root).getPropertyValue('--azul').trim();
    root.style.setProperty('--backgroundColor', azul);
  }
}

async function changeRole() {
  await authStore.changeUserRole();
  await changeColor();
}

</script>

<template>
  <header>
    <navbar>
      <div>
        <img src="../../public/favicon.ico" />
      </div>
      <div class="navLinks">
        <button v-if="!authStore.isRecruiter">
          <RouterLink to="/dashboard" class="noUnderline">
            <font-awesome-icon class="iconsNavLink" icon="house" />
            <li>Início</li>
          </RouterLink>
        </button>
        <button v-if="authStore.isRecruiter">
          <RouterLink to="/dashboard" class="noUnderline">
            <font-awesome-icon class="iconsNavLink" icon="fa-solid fa-eye" />
            <li>Candidaturas</li>
          </RouterLink>
        </button>

        <button v-if="!authStore.isRecruiter">
          <RouterLink :to="{ name: 'vacancies' }" class="noUnderline">
            <font-awesome-icon class="iconsNavLink" icon="fa-solid fa-clipboard" />
            <li>Minhas Vagas</li>
          </RouterLink>
        </button>
        <button v-if="authStore.isRecruiter">
          <RouterLink :to="{ name: 'vacancies' }" class="noUnderline">
            <font-awesome-icon class="iconsNavLink" icon="fa-solid fa-clipboard" />
            <li>Gerir Vagas</li>
          </RouterLink>
        </button>

        <button>
          <RouterLink to="/profile" class="noUnderline">
            <font-awesome-icon class="iconsNavLink" icon="fa-solid fa-user" />
            <li>Perfil</li>
          </RouterLink>
        </button>

        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <font-awesome-icon class="iconsNavLink" icon="fa-solid fa-circle-chevron-down" />
            <li>Outros</li>
          </button>

          <ul class="dropdown-menu">
            <li v-if="!authStore.isRecruiter"><a class="dropdown-item" @click="changeRole">Trocar para recrutador</a></li>
            <li v-if="authStore.isRecruiter"><a class="dropdown-item"  @click="changeRole">Trocar para candidato</a></li>
            <li><a class="dropdown-item" @click="authStore.userLogout">Logout</a></li>
          </ul>
        </div>
      </div>
    </navbar>
  </header>
</template>

<style scoped>

.noUnderline {
  text-decoration: none;
  color: inherit;
}

navbar img {
  height: 50px;
}

navbar {
  display: flex;
  justify-content: space-between;
  margin: 15px 6% 15px 6%;
  align-items: center;
  height: 50px;
}

.navLinks {
  display: flex;
  justify-content: end;
  list-style-type: none;
  align-items: center;
  flex-wrap: nowrap;
  width: 30%;
  gap: 4vw;
}

.navLinks button:hover {
  transition: 0.2s;
  color: var(--backgroundColor);
}

.navLinks button:hover .iconsNavLink {
  color: var(--backgroundColor);
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

.dropdown-toggle::after {
  display: none;
}

.router-link-active {
  color: var(--backgroundColor);
  font-weight: bold;
}

.router-link-active .iconsNavLink {
  color: var(--backgroundColor);
}

button .router-link-active {
  color: var(--backgroundColor);
}

button .router-link-active .iconsNavLink {
  color: var(--backgroundColor);
}

.dropdown-item {
  cursor: pointer;
  }

.btn {
  padding: 0px;
}
</style>
