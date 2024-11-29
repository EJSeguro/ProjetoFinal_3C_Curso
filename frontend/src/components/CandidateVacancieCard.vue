<script setup>
import { onMounted, ref } from "vue";
import { getImage } from "@/services/HttpService";
import CandidateVacancieOffcanvas from "./CandidateVacancieOffcanvas.vue";

const props = defineProps({
    vacancy: {
        type: Object,
    },
});

const imageUrl = ref(null);

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
        <div class="cardInfos">
            <h3>{{ props.vacancy.title }}</h3>
            <p v-if="props.vacancy.category === 'presencial'">Presencial</p>
            <p v-if="props.vacancy.category === 'homeoffice'">Home Office</p>
            <p v-if="props.vacancy.category === 'hybrid'">Híbrido</p>
            <p>{{ props.vacancy.field }} | {{ props.vacancy.location }}</p>
            
        </div>
        <button><font-awesome-icon class="arrowIcon" icon="fa-solid fa-chevron-right" /></button>
    </div>
</template>

<style scoped>
.card {
    padding: 10px;
    background-color: #fff;
    height: 120px;
    width: 450px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    gap: 30px;
}

.cardInfos {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.cardInfos p{
    font-size: 15px;
}

.cardInfos h3{
    font-size: 20px;
}

button {
    all: unset;
    display: inline-block;
    cursor: pointer;
    height: 40px;
}

.arrowIcon {
    height: 30px;
}

.card img {
    height: 100%;
    min-width: 120px;
    max-width: 120px;
}
</style>
