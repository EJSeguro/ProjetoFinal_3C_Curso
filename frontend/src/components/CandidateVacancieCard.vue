<script setup>
import { onMounted, ref } from "vue";
import { getImage } from "@/services/HttpService";

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
            <p>{{ props.vacancy.location }}</p>
            <p>
                {{ props.vacancy.field }} |
                <span v-if="props.vacancy.category === 'presencial'">Presencial</span>
                <span v-else-if="props.vacancy.category === 'homeoffice'">Home Office</span>
                <span v-else-if="props.vacancy.category === 'hybrid'">Híbrido</span>
            </p>

        </div>
        <button><font-awesome-icon class="arrowIcon" icon="fa-solid fa-chevron-right" /></button>
    </div>
</template>

<style scoped>
.card {
    padding: 10px;
    background-color: #fff;
    min-height: 200px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: row;
    gap: 30px;
    overflow: hidden;
    --bs-card-border-radius: unset;
}

.cardInfos {
    display: flex;
    flex-direction: column;
    height: 100px;
    width: 100%;
    padding: 2%;
}

.cardInfos p {
    font-size: 15px;
    margin: 0;
}

.cardInfos h3 {
    font-size: 20px;
    margin: 0;
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
    min-width: 150px;
    max-width: 150px;
}
</style>
