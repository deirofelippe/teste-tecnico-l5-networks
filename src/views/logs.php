<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Catálogo Star Wars</title>
</head>

<body>
  <header>
    <nav>
      <a href="/">CATALOGO</a>
      <a href="/">Home</a>
      <a href="/logs">Logs</a>
    </nav>
  </header>

  <main>
    <table class="table table-striped mx-1 my-2">
      <thead>
        <tr>
          <th scope="col" style="width: 10%">Data</th>
          <th scope="col" style="width: 8%">Level</th>
          <th scope="col" style="width: 8%">Contexto</th>
          <th scope="col" style="width: 84%">Descrição</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['logs'] as $index => $log) { ?>
          <tr>
            <th scope="row"><?=$log['datetime'] ?></th>
            <td><?=$log['level'] ?></td>
            <td><?=$log['context'] ?></td>
            <td><?=$log['description'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </main>

  <div class="">
    <a href="/logs?limit=<?=$data['limit'] ?>&offset=<?=$data['previous'] ?>">Anterior</a>
    <span>
      <?=$data['offset'] ?> de <?=$data['total_logs'] ?> logs
    </span>
    <a href="/logs?limit=<?=$data['limit'] ?>&offset=<?=$data['next'] ?>">Próximo</a>
  </div>

  <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>

</html>