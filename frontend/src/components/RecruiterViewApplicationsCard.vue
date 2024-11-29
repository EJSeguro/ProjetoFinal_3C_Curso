<script setup>
import { onMounted, ref } from "vue";
import { getImage } from "@/services/HttpService";
import { useApplicationStore } from "@/stores/applicationStore";

const applicationStore = useApplicationStore();

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
                <button type="button" class="btn btn-primary" :data-bs-toggle="'modal'"
                    :data-bs-target="'#applicationModal' + props.vacancy.id" @click="applicationStore.getApplicationFromVacancy(props.vacancy.id)">
                    Candidaturas
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" :id="'applicationModal' + props.vacancy.id" tabindex="-1"
        aria-labelledby="'applicationModalLabel' + props.vacancy.id" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" :id="'applicationModalLabel' + props.vacancy.id">
                        {{ props.vacancy.title }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Descrição</h3>
                    <p>{{ props.vacancy.description }}</p>
                    <hr />
                    <div v-if="applicationStore.applications.length > 0">
                        <h4>Candidaturas</h4>
                        <ul >
                            <li v-for="application in applicationStore.applications" :key="application.id">
                                {{ application.user.name }} 
                            </li>
                        </ul>
                    </div>
                    <div v-else>
                        Sem candidaturas
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>
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

.card img {
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

.buttonView {
    display: flex;
    justify-content: center;
    align-items: end;
}

.buttonView button {
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
