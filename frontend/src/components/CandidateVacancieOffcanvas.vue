<script setup>

import { deleteApplication, storeApplication } from '@/services/HttpService';

const props = defineProps({
    title: '',
    description: '',
    category: '',
    field: '',
    location: '',
    active: '',
    id: '',
});

const applicate = async () => {
    const response = await storeApplication({
        vacancy_id: props.id,
    });

    if (response.status === 200) {
        alert('Você se candidatou com sucesso!');
    }
};

const deapplicate = async () => {
    const response = await deleteApplication(props.id);

    if (response.status === 200) {
        alert('Você se descandidatou com sucesso!');
    }
};

</script>

<template>
    <div>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
            aria-controls="offcanvasScrolling">Enable body scrolling</button>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
            id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Detalhes da vaga</h5>
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

                <button class="btn btn-primary" type="button" data-bs-dismiss="offcanvas"
                    @click="applicate">Aplicar</button>
            </div>

        </div>
    </div>
</template>

<style scoped></style>