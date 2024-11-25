<script setup>
import { ref } from 'vue';
import { storeVacancy, updateVacancy } from '@/services/HttpService';
import { Modal } from 'bootstrap';

const props = defineProps({
    initialTitle: "",
    initialDescription: "",
    initialCategory: "",
    initialImage: "",
    initialField: "",
    initialLocation: "",
    initialActive: "",
    isEdit: false,
    id: null,
    addVacancy: null,
});

const title = ref(props.initialTitle);
const description = ref(props.initialDescription);
const category = ref(props.initialCategory);
const image = ref(props.initialImage);
const field = ref(props.initialField);
const location = ref(props.initialLocation);
const active = ref(props.initialActive);

const resetForm = () => {
    if (!props.isEdit) {
        title.value = "";
        description.value = "";
        category.value = "";
        image.value = "";
        field.value = "";
        location.value = "";
        active.value = false;
    }
};

const closeModal = () => {
    const modalElement = document.getElementById('vacancyModal');
    if (modalElement) {
        const modalInstance = Modal.getInstance(modalElement) || new Modal(modalElement);
        modalInstance.hide();
        resetForm();
    }
};

const storeUpdateVacancy = async () => {
    const vacancyData = {
        title: title.value,
        description: description.value,
        category: category.value,
        image: image.value,
        field: field.value,
        location: location.value,
        active: active.value,
    };

    if (props.isEdit) {
        const response = await updateVacancy(props.id, vacancyData);

        if (response.status === 200) {
            alert("Vaga atualizada com sucesso!");
            closeModal();
        }
    } else {
        const response = await storeVacancy(vacancyData);

        if (response.status === 201) {
            props.addVacancy(vacancyData);
            closeModal();
        }
    }
};
</script>

<template>
    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#vacancyModal">
        Nova Vaga
    </button>
    <div class="modal fade" id="vacancyModal" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title ? "Editar Vaga" : "Nova Vaga" }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="storeUpdateVacancy">
                        <div class="mb-3">
                            <label for="title" class="form-label">Título da Vaga</label>
                            <input type="text" class="form-control" v-model="title" placeholder="Título da Vaga" />
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrição da Vaga</label>
                            <textarea class="form-control" v-model="description" rows="3"
                                placeholder="Descrição da Vaga"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Categoria da Vaga</label>
                            <input type="text" class="form-control" v-model="category"
                                placeholder="Categoria da Vaga" />
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Imagem da Vaga</label>
                            <input type="text" class="form-control" v-model="image" placeholder="Imagem da Vaga" />
                        </div>
                        <div class="mb-3">
                            <label for="field" class="form-label">Campo de Pesquisa</label>
                            <input type="text" class="form-control" v-model="field" placeholder="Campo de Pesquisa" />
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Local da Vaga</label>
                            <input type="text" class="form-control" v-model="location" placeholder="Local da Vaga" />
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" v-model="active" />
                            <label class="form-check-label">Ativo</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Salvar Vaga</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.btn-primary {
    background-color: var(--roxo);
    border: none;
    color: white;
}
</style>
