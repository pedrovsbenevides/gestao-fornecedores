export async function loadClassificacao() {
    const demandas = await fetch('http://localhost:8000/routes/listDemandasFornecedores.php').then(response => response.json());

    const container = document.getElementById('classificacao');
    demandas.forEach(demanda => {
        const div = document.createElement('div');
        div.className = 'demanda';
        div.innerHTML = `<h2>${demanda.titulo} (CEP: ${demanda.cep})</h2>`;

        const ul = document.createElement('ul');

        if (demanda.fornecedores.length == 0) {
            const li = document.createElement('li');
            li.textContent = 'Não existem fornecedores atribuidos a essa demanda.';
            ul.appendChild(li);
        } else {
            demanda.fornecedores.forEach(f => {
                const li = document.createElement('li');
                li.textContent = `${f.razao_social} - CEP: ${f.cep} (${f.distancia_demanda} km)`;
                ul.appendChild(li);
            });
        }

        div.appendChild(ul);
        container.appendChild(div);
    });
}