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

const modal = ref(false);

</script>

<template>
    <div class="card">
        <img v-if="props.vacancy.image" :src="imageUrl" />
        <img v-else src="../assets/vacancy.webp" />
        <div class="cardInfos">
            <div>
            <h3>{{ props.vacancy.title }}</h3>
            <p>{{ props.vacancy.location }}</p>
            <p>
                {{ props.vacancy.field }} |
                <span v-if="props.vacancy.category === 'presencial'">Presencial</span>
                <span v-else-if="props.vacancy.category === 'homeoffice'">Home Office</span>
                <span v-else-if="props.vacancy.category === 'hybrid'">Híbrido</span>
            </p>
            </div>
            <div class="buttonView">
                <button @click="modal = true">Visualizar Candidaturas</button>
            </div>
            
        </div>
    </div>
    <div v-if="modal" class="modal">
        <div class="modalContent">
            <h3>{{ props.title }}</h3>
            <button @click="modal = false">Fechar</button>
        </div>
        <div class="modalContent">
            <h3>Descrição</h3>
            <p>{{ props.description }}</p>
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
    overflow: hidden;
}

.card img{
    max-width: 150px;
    min-width: 150px;
    height: 100%;

}

.cardInfos {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    width: 50%;
    flex-wrap: nowrap;
}

.buttonView{
    display: flex;
    justify-content: center;
    align-items: end;
}

.buttonView button{
    background-color: var(--azul);
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    height: 40px;
    width: 100%;
    gap: 10px;
    font-weight: 550;
}

</style>
