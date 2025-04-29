# Gestão de Fornecedores

1. No dirétorio backend execute o comando `php -S localhost:8000`
2. Com o servidor em execução, inicie o liveserver para as paginas HTML em `http://127.0.0.1:5500`
3. Acesse `http://127.0.0.1:5500/frontend/cadastro.html`

Caso haja necessidade o banco de dados pode ser resetado ao deletar o arquivo [database.sqlite](./backend/db/database.sqlite), criar outro de mesmo nome e acessar `localhost:8000/db/migrations/base_migration.php` com o backend em execução. Com o setup concluído com sucesso será exibida a mensagem 'Migrated'.
