import { createDemanda } from "./createDemanda.js";
import { createFornecedor } from "./createFornecedor.js";

document.addEventListener('DOMContentLoaded', () => {

    document.getElementById('formDemanda').onsubmit = async (e) => {
        e.preventDefault();

        let demandaFormData = {
            titulo: document.getElementById('demandaTituloInput').value,
            cep: document.getElementById('demandaCepinput').value
        }

        // let response = await fetch('http://localhost:8000/routes/demandas.php', {
        //     method: 'POST',
        //     body: JSON.stringify(demandaFormData)
        // });
        let response = await createDemanda(demandaFormData);

        if (response.status == 200) {

            alert('Demanda cadastrada com sucesso!');
        } else {
            let response = await response.json();
            alert(response.error);
        }

        e.target.reset();
    };

    document.getElementById('formFornecedor').onsubmit = async (e) => {
        e.preventDefault();

        let fornecedorFormData = {
            razao_social: document.getElementById('fornecedorRazaoSocialInput').value,
            cep: document.getElementById('fornecedorCepInput').value,
        }

        // let response = await fetch('http://localhost:8000/routes/fornecedores.php', {
        //     method: 'POST',
        //     body: fornecedorFormData
        // });
        let response = await createFornecedor(fornecedorFormData);

        if (response.status == 200) {

            alert('Fornecedor cadastrado com sucesso!');
        } else {
            let response = await response.json();
            alert(response.error);
        }

        e.target.reset();
    };
});