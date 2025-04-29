export async function assocDemandaFornecedores(formData) {
    let response = await fetch('http://localhost:8000/routes/associacaoFornecedores.php', {
        method: 'POST',
        body: JSON.stringify(formData)
    });

    return response;
}