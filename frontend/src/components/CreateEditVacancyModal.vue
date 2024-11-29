<script setup>
import { ref, defineProps, computed } from 'vue';
import { storeVacancy, updateVacancy, uploadImage } from '@/services/HttpService';
import { Modal } from 'bootstrap';
import { useVacancyStore } from '@/stores/vacancyStore';

const vacancyStore = useVacancyStore();

const props = defineProps({
    initialTitle: "",
    initialDescription: "",
    initialCategory: "",
    initialField: "",
    initialLocation: "",
    initialActive: "",
    initialCompany: "",
    isEdit: false,
    id: null,
    updateVacancy: null,
});

const title = ref(props.initialTitle);
const description = ref(props.initialDescription);
const category = ref(props.initialCategory);
const field = ref(props.initialField);
const company = ref(props.initialCompany);
const location = ref(props.initialLocation);
const active = ref(props.initialActive);
const modalId = computed(() => (props.id ? `modalEdit-${props.id}` : "newVacancyModal"));

const image = ref(null);

const resetForm = () => {
    if (!props.isEdit) {
        title.value = "";
        description.value = "";
        category.value = "";
        field.value = "";
        company.value = "";
        location.value = "";
        active.value = false;
    }
};

const closeModal = () => {
    const modalElement = document.getElementById(modalId.value);
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
        field: field.value,
        location: location.value,
        active: active.value,
        company: company.value,
    };

    if (props.isEdit) {
        const response = await updateVacancy(props.id, vacancyData);

        if (response.status === 200) {

            if(image.value) {
                response.data.imageUpdate = await uploadVacancyImage(props.id);
            }

            props.updateVacancy(response.data);
            closeModal();
        }
    } else {
        const response = await storeVacancy(vacancyData);

        if (response.status === 201) {
            
            if(image.value) {
                response.data.vacancy.image = await uploadVacancyImage(response.data.vacancy.id);
            }

            vacancyStore.addVacancy(response.data.vacancy);
            closeModal();
        }
    }
};

const handleImage = (event) => {
  const file = event.target.files[0];
 
  if (file) {
    image.value = file;
  }
};

const uploadVacancyImage = async (vacancyId) => {
  const data = new FormData();
  data.append("image", image.value);
  data.append("type", "vacancy");
  data.append("vacancyId", vacancyId);

  const response = await uploadImage(data);

  if (response.status === 201) {
    return response.data.path;
  }
};

</script>

<template>
    <button class="btn btn-primary" type="button" data-bs-toggle="modal" :data-bs-target="'#' + modalId">
        {{ initialTitle ? "Editar Vaga" : "Nova Vaga" }}
    </button>
    <div class="modal fade" :id="modalId" tabindex="-1" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ initialTitle ? "Editar Vaga" : "Nova Vaga" }}</h5>
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
                            <label for="company" class="form-label">Empresa</label>
                            <input type="text" class="form-control" v-model="company" placeholder="Empresa" />
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Categoria da Vaga</label>
                            <select class="form-select" v-model="category"
                                placeholder="Categoria da Vaga">
                                <option value="presencial">Presencial</option>
                                <option value="homeoffice">Home Office</option>
                                <option value="hybrid">Híbrido</option>
                        </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Imagem da Vaga</label>
                            <input type="file" class="form-control" placeholder="Imagem da Vaga" accept="image/*" @change="handleImage" id="image"/>
                        </div>
                        <div class="mb-3">
                            <label for="field" class="form-label">Área de atuação</label>
                            <input type="text" class="form-control" v-model="field" placeholder="Área de atuação" />
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Local da Vaga</label>
                            <input type="text" class="form-control" v-model="location" placeholder="Local da Vaga" />
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" checkedclass="form-check-input" v-model="active" />
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
