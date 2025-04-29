export async function createDemanda(demandaFormData) {
    let response = await fetch('http://localhost:8000/routes/demandas.php', {
        method: 'POST',
        body: JSON.stringify(demandaFormData)
    });

    return response;
}