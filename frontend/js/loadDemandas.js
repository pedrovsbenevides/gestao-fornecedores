export async function loadDemandas() {
    const demandas = await fetch('http://localhost:8000/routes/listDemandas.php').then(response => response.json());

    const demandaSelect = document.getElementById('demandaSelect');
    demandas.forEach(d => {
        const opt = document.createElement('option');
        opt.value = d.id;
        opt.textContent = `${d.titulo} (${d.cep})`;
        demandaSelect.appendChild(opt);
    });
}