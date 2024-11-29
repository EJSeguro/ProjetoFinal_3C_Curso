<script setup>

import { useApplicationStore } from '@/stores/applicationStore';

const props = defineProps({
    title: '',
    description: '',
    category: '',
    field: '',
    location: '',
    active: '',
    id: '',
    application: {},
});

const applicationStore = useApplicationStore();

const applicate = async () => {
    applicationStore.applicate({ vacancy_id: props.id });
};

const deapplicate = async () => {
    applicationStore.deapplicate(props.application?.id);
};

</script>

<template>
    <div>
        <button
            class="btn btn-primary"
            type="button"
            :data-bs-toggle="'offcanvas'"
            :data-bs-target="'#offcanvas-' + props.id"
            :aria-controls="'offcanvas-' + props.id"
        >
            Ver mais
        </button>
        <div
            class="offcanvas offcanvas-start"
            data-bs-scroll="true"
            data-bs-backdrop="false"
            tabindex="-1"
            :id="'offcanvas-' + props.id"
            :aria-labelledby="'offcanvas-label-' + props.id"
        >
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" :id="'offcanvas-label-' + props.id">Detalhes da vaga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <p>Título: {{ props.title }}</p>
                    <p>Descrição: {{ props.description }}</p>
                    <p>Categoria: {{ props.category }}</p>
                    <p>Área de atuação: {{ props.field }}</p>
                    <p>Local: {{ props.location }}</p>
                    <p>Ativo: {{ props.active }}</p>
                </div>
                <button
                    v-if="!props.application?.id"
                    class="btn btn-primary"
                    type="button"
                    data-bs-dismiss="offcanvas"
                    @click="applicate"
                >
                    Aplicar
                </button>
                <button
                    v-else
                    class="btn btn-primary"
                    type="button"
                    data-bs-dismiss="offcanvas"
                    @click="deapplicate"
                >
                    Desistir
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>