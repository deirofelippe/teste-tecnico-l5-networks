<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        <div>
          <?php foreach ($data as $index => $film) { ?>
            <div>
              <h1><?=$film['title'] ?></h1>
              <p><?=$film['release_date'] ?></p>
              <a href="/film/<?=$film['id'] ?>">Ver detalhes</a>
            </div>
          <?php } ?>
        </div>
    </main>

    <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>