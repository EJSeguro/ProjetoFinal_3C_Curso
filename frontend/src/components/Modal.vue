<template>
    <div class="modal-overlay" @click.self="close">
      <div class="modal-content">
        <header class="modal-header">
          <h3>{{ title }}</h3>
          <button class="modal-close" @click="close">&times;</button>
        </header>
        <div class="modal-body">
          <slot />
        </div>
        <footer class="modal-footer">
          <button class="modal-save" @click="save">Salvar</button>
        </footer>
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, defineEmits } from "vue";
  
  defineProps({
    title: {
      type: String,
      default: "Modal Title",
    },
  });
  
  const emit = defineEmits(["close", "save"]);
  
  // Fecha o modal
  const close = () => {
    emit("close");
  };
  
  // Salva as informações do modal
  const save = () => {
    emit("save");
  };
  </script>
  
  <style scoped>
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
  }
  
  .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
  }
  
  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
  }
  
  .modal-header h3 {
    font-size: 20px;
    margin: 0;
  }
  
  .modal-close {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
  }
  
  .modal-body {
    margin: 20px 0;
  }
  
  .modal-footer {
    display: flex;
    justify-content: flex-end;
  }
  
  .modal-save {
    padding: 10px 20px;
    background-color: rgb(134, 156, 255);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  .modal-save:hover {
    background-color: rgb(114, 136, 235);
  }
  </style>
  