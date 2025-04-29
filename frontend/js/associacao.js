import { loadDemandas } from './loadDemandas.js';
import { loadFornecedores } from './loadFornecedores.js';
import { assocDemandaFornecedores } from './assocDemandaFornecedores.js';

document.addEventListener('DOMContentLoaded', () => {
    loadDemandas();
    loadFornecedores();

    document.getElementById('formAssociacao').onsubmit = async (e) => {
        e.preventDefault();

        const demandaId = document.getElementById('demandaSelect').value;
        const fornecedoresSelecionados = Array.from(document.querySelectorAll('input[name="fornecedores_ids"]:checked'))
            .map(input => parseInt(input.value));

        if (fornecedoresSelecionados.length === 0) {
            alert('Selecione pelo menos um fornecedor!');
            return;
        }

        const formData = {
            demanda_id: parseInt(demandaId),
            fornecedores_ids: fornecedoresSelecionados
        };

        let response = await assocDemandaFornecedores(formData);

        if (response.status == 200) {

            alert('Fornecedores associados com sucesso!');
        } else {
            let response = await response.json();
            alert(response.error);
        }
        e.target.reset();
    };
});