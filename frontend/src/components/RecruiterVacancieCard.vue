<script setup>
import { onMounted, ref } from "vue";
import CreateEditVacancyModal from "./CreateEditVacancyModal.vue";
import { deleteVacancy, getImage } from "@/services/HttpService"; 
import { useVacancyStore } from "@/stores/vacancyStore";

const props = defineProps({
  vacancy: {
    type: Object,
  },
});

const vacancyStore = useVacancyStore();

const imageUrl = ref(null);

const localVacancy = ref({ ...props.vacancy });

async function updateVacancy(updatedVacancy) {
  localVacancy.value = updatedVacancy;
  if (updatedVacancy.imageUpdate) {
    await getImageUrl();
  }
}

async function getImageUrl() {
    const { data } = await getImage("vacancy", localVacancy.value.id);
    imageUrl.value = data.url;
}

onMounted(async () => {
  if(localVacancy.value.image) {
    await getImageUrl();
  }
});

async function deleteVacancyRecruiter() {
  const response = await deleteVacancy(localVacancy.value.id);

  if (response.status === 200) {
    vacancyStore.deleteVacancy(localVacancy.value.id);
  }
}
</script>

<template>
  <div class="card">
    <img v-if="localVacancy.image" :src="imageUrl" />
    <img v-else src="../assets/vacancy.webp" />
    <div class="cardInfos">
      <h3>{{ localVacancy.title }}</h3>
      <p v-if="localVacancy.category === 'presencial'">Presencial</p>
      <p v-if="localVacancy.category === 'homeoffice'">Home Office</p>
      <p v-if="localVacancy.category === 'hybrid'">Híbrido</p>
      <p>{{ localVacancy.field }}</p>
      <p>{{ localVacancy.location }}</p>
      <div>
        <CreateEditVacancyModal :initialTitle="props.vacancy.title" :initialDescription="props.vacancy.description"
          :initialCategory="props.vacancy.category" :initialField="props.vacancy.field", :initialCompany="props.vacancy.company"
          :initialLocation="props.vacancy.location" :initialActive="props.vacancy.active" :id="props.vacancy.id"
          :updateVacancy="updateVacancy" isEdit="true" />

        <font-awesome-icon data-bs-toggle="dropdown" class="trashCan" icon="fa-solid fa-trash-can" />

        <div class="dropdown">
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" @click="deleteVacancyRecruiter()">Apagar</a></li>
            <li><a class="dropdown-item">Cancelar</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>

</template>

<style scoped>
.card {
  padding: 16px;
  border-radius: 8px;
  background-color: #fff;
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
  width: 180px;
}

.trashCan {
  position: absolute;
  right: 20px;
  bottom: 40px;
  color: red;
  font-size: 25px;
  cursor: pointer;
}

.dropdown-item{
  cursor: pointer;
}
</style>
