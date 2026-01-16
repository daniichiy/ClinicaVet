document.getElementById("tratamento").addEventListener("change", function () {
    const optionSelecionada = this.options[this.selectedIndex];
    const descricao = optionSelecionada.getAttribute("data-descricao");

    const textarea = document.getElementById("descricaoTratamento");
    textarea.value = descricao ?? '';
});