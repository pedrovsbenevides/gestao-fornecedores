export async function createFornecedor(fornecedorFormData) {
    let response = await fetch('http://localhost:8000/routes/fornecedores.php', {
        method: 'POST',
        body: JSON.stringify(fornecedorFormData)
    });

    return response;
}