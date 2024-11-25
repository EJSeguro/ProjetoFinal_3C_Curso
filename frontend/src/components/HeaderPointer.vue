<script setup></script>

<template>
  <header>
    <navbar>
      <div>
        <img src="../../public/favicon.ico" />
      </div>
      <div class="navLinks">
        <button>
          <RouterLink to="/dashboard" class="noUnderline">
            <font-awesome-icon class="iconsNavLink" icon="house" />
            <li>Início</li>
          </RouterLink>
        </button>
        <button>
          <RouterLink to="/myVacancies" class="noUnderline">
            <font-awesome-icon
              class="iconsNavLink"
              icon="fa-solid fa-clipboard"
            />
            <li>Minhas Vagas</li>
          </RouterLink>
        </button>
        <button>
          <RouterLink to="/profile" class="noUnderline">
            <font-awesome-icon class="iconsNavLink" icon="fa-solid fa-user" />
            <li>Perfil</li>
          </RouterLink>
        </button>
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
</style>
