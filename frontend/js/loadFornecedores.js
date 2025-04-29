export async function loadFornecedores() {
    const fornecedores = await fetch('http://localhost:8000/routes/listFornecedores.php').then(response => response.json());

    const fornecedoresContainer = document.getElementById('fornecedoresContainer');
    fornecedores.forEach(f => {
        const div = document.createElement('div');
        div.className = 'fornecedor-item';
        div.innerHTML = `
        <label>
            <input type="checkbox" name="fornecedores_ids" value="${f.id}">
            ${f.razao_social} (${f.cep})
        </label>
        `;
        fornecedoresContainer.appendChild(div);
    });
}