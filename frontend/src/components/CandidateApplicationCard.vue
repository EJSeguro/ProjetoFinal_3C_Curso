<script setup>
import { onMounted, ref } from "vue";
import { getImage } from "@/services/HttpService";
import { useApplicationStore } from "@/stores/applicationStore";

const imageUrl = ref(null);

const applicationStore = useApplicationStore();

const props = defineProps({
  vacancy: {
    type: Object,
  },
  application: {
    type: Object,
  }
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

</script>
<template>
  <div class="card">
    <img v-if="props.vacancy.image" :src="imageUrl" />
    <img v-else src="../assets/vacancy.webp" />
    <div class="cardInfosContainer">
      <div class="cardInfos">
        <h3>{{ props.vacancy.title }}</h3>
        <p>{{ props.vacancy.category }} | {{ props.vacancy.field }}</p>
        <p>{{ props.vacancy.location }}</p>
      </div>
      <div class="buttonView">
        <button
          type="button"
          class="btn btn-roxo"
          :data-bs-toggle="'modal'"
          :data-bs-target="'#vacancyModal' + props.vacancy.id"
        >
          Visualizar
        </button>
      </div>
    </div>
  </div>
  <div
    class="modal fade"
    :id="'vacancyModal' + props.vacancy.id"
    tabindex="-1"
    aria-labelledby="'vacancyModalLabel' + props.vacancy.id"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" :id="'vacancyModalLabel' + props.vacancy.id">
            {{ props.vacancy.title }}
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <img v-if="props.vacancy.image" :src="imageUrl" class="img-fluid" />
          <img v-else src="../assets/vacancy.webp" class="img-fluid" />
          <p class="mt-3"><strong>Empresa:</strong> {{ props.vacancy.company }}</p>
          <p>
            <strong>Categoria:</strong> {{ props.vacancy.category }}
          </p>
          <p><strong>Campo:</strong> {{ props.vacancy.field }}</p>
          <p><strong>Localização:</strong> {{ props.vacancy.location }}</p>
          <p><strong>Descrição:</strong> {{ props.vacancy.description }}</p>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Fechar
          </button>
          <button type="button" class="btn btn-roxo" @click="applicationStore.deapplicate(props.application.id)" data-bs-dismiss="modal">Desistir</button>
        </div>
      </div>
    </div>
  </div>
</template>


<style scoped>
.cardInfosContainer {
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

.buttonView button {
  border-radius: 10px;
  height: 40px;
  width: 200px;
  font-weight: 550;
}

.card img {
  height: 100%;
  width: 180px;
}

.btn-roxo {
  background-color: var(--roxo);
  color: white;
}

</style>