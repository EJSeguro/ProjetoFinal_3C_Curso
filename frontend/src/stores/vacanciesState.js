// import { ref } from "vue";

// // Estado global para vagas candidatas
// export const myVacancies = ref([]);

// // Método para adicionar vaga
// export function addToMyVacancies(vaga) {
//   const exists = myVacancies.value.some((v) => v.id === vaga.id);
//   if (!exists) {
//     myVacancies.value.push(vaga);
//     localStorage.setItem("myVacancies", JSON.stringify(myVacancies.value));
//     console.log("Vaga salva:", myVacancies.value); // Adicione esta linha
//     alert(`${vaga.name} adicionada às Minhas Vagas!`);
//   } else {
//     alert(`${vaga.name} já está em Minhas Vagas.`);
//   }
// }

// // Inicializa as vagas a partir do localStorage
// if (localStorage.getItem("myVacancies")) {
//   myVacancies.value = JSON.parse(localStorage.getItem("myVacancies"));
// }
