<script setup>
import { computed, defineProps } from "vue";

const props = defineProps({
    changeForm: {
        type: Function,
    },
    value: {
        type: Boolean,
    },
});

const computedClassTrue = computed(() => {
    return props.value ? "statusActive" : "statusInactive";
});

const computedClassFalse = computed(() => {
    return !props.value ? "statusActive" : "statusInactive";
});
</script>

<template>
    <div class="escolhaForm">
        <button @click="changeForm(true)" :disabled="value" :class="computedClassTrue">
            Entrar
        </button>
        <button @click="changeForm(false)" :disabled="!value" :class="computedClassFalse">
            Cadastrar-se
        </button>
    </div>
</template>

<style scoped>
.escolhaForm {
    display: flex;
    justify-content: space-around;
    width: 100%;
    margin-bottom: 20px;
    border-bottom: 2px solid rgba(155, 155, 155, 0.438);
    padding-bottom: 12px;
}

.escolhaForm button {
    border: none;
    width: 50%;
    height: 30px;
    border-radius: 15px;
}


.statusActive {
    background-color: rgb(61, 41, 240);
    color: white;
}

.statusInactive {
    background-color: white;
    color: black;
}
</style>
