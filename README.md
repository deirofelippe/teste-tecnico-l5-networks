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
    - O site deve ser responsivo
    - Validações nos dados de entrada e no banco de dados
    - Usar APM para monitorar a performance
    - GitHub Actions CI: Rodar testes automatizados e permitir o merge só quando tudo funcionou
    - Testar o frontend e backend com o cypress
    - Usar API versioning
    - Ferramentas de qualidade de código (PHP CS Fixer, PHP Stan)
- Melhorias:
    - GitHub Actions CD: Fazer deploy de forma automática
    - Cache
        - Criar expiracao
        - Tratar erros
    - Http request
        - Retry e timeout
        - Tratar erros
    - Testes
        - Fazer testes de unidade
        - Cobertura de codigo de 80%
    - Código modular e de fácil manutenção
    - Validar todos os campos de entrada, limit, offset
    - Segurança
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
    - Indíce, fulltextsearch para busca mais rápida, caso o sistema esteja lento.
    - Uso de framework para facilitar o uso



// gerenciador de dependencias
// render em classe diferente
// mais dinamico as rotas e registros

terminar logs
criar login e cadastro
fazer comentarios
faze pagina de characters
tratamento de erro global com erro 500 em caso de problema
    http_response_code(500)
    header("HTTP/1.1 404 Not Found")
    header("Content-Type: application/json")
        echo json_encode(["name"=>"Felippe"])

usar jquery
fazer teste de carga

// testar se data está no padrão certo, se está ordenado, quantidade next previous e outros, limpar os registros das tabelas

// v1 - terminar os logs e paginas com bootstrap
// v1.1 - login e pagina
// v1.2 - comentarios e pagina
