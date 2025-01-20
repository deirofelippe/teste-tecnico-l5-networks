# Anotações

## Backlog

- Requisitos obrigatórios:
    - PHP 7.4, PHP com POO, MySQL, código 100% desenvolvido
    - HTML, CSS, Javascript, JQuery e Bootstrap
    - Código deverá ser encaminhado
    - Dump do banco de dados
    - Lista de melhorias
    - Os dados dos filmes deverão ser buscados pela API `https://swapi.py4e.com/`
    - Usuário pode lista os filmes do Star Wars
        - Ordenado por: data de lançamento.
        - Exibir: nome e data de lançamento.
    - Usuário pode selecionar um filme e ver seus detalhes
        - Nome;
        - Nº episódio;
        - Sinopse;
        - Data de lançamento;
        - Diretor(a);
        - Produtor(es);
        - Nome dos personagens;
        - A idade dos filmes em anos, meses e dias. Calculo deve ser feito no backend.
    - A exibição das telas devem ser em páginas e endpoints diferentes.
    - Sempre que houver requisição a API local, deve ser registrado um log com informações de data/hora e a solicitação.
    - Organização em MVC.
    - O usuário poderá ver os logs, datetime, evento, level, path, status code
        - Pode filtrar por level, datetime e status code
- Requisitos não obrigatórios:
    - Usuário pode se cadastrar
    - Somente usuário cadastrado pode fazer um ranking de filmes e ver rankings de outras pessoas
    - Usuário pode listar os filmes mais amados
    - Validações nos dados de entrada e no banco de dados
    - Usar APM para monitorar a performance
    - GitHub Actions CI: Rodar testes automatizados e permitir o merge só quando tudo funcionou
    - Testar o frontend e backend com o cypress
    - Usar API versioning
    - Ferramentas de qualidade de código (PHP CS Fixer, PHP Stan)
- Documentação:
    - Desenho da arquitetura
    - Desenho e explicação da organização das pastas
    - Commits organizados e pequenos
    - Fazer vídeo usando e instalando o projeto
    - Screenshots do projeto
    - Como instalar, executar, executar os testes, usar o docker, usar o cypress
    - Modelagem de dados, DER
    - Quanto de recurso o sistema consome em quais cargas (K6 e APM)
- Explicações (explicar melhorias também)
    - CI/CD e Code Owners
    - Cache na API do Star Wars
    - K6 e APM
    - Cypress
    - Docker

## Melhorias realizadas

- Visualização dos logs
- Página dos personagens
- Criação de comentários no filme
- Listagem de comentários de cada autor
- Testes automatizados
- Pipeline CI/CD no GitHub para verificar se o código está funcionando.
- Cache (em disco) em cada requisição para aumentar a performance e não atingir o máximo de requests da API do Star Wars usada.

## Melhorias futuras

- Testes com Cypress para garantir que o frontend e backend estão funcionando corretamente.
- Tempo de expiração no cache.
- Deixar mais dinâmico as rotas, a query string, o path parameter.
- Organizar o a lógica que irá chamar o controller baseado na rota.
- Fazer mais testes unitários para a lógica do service e de outras camadas.