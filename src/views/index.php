<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="/index.css" type="text/css">
        <link rel="stylesheet" href="<?="/$page_name.css"?>" type="text/css">

        <title>Catalogo Star Wars</title>
    </head>

    <body>
        <header class="header-nav border-bottom mb-4">
            <div class="container d-flex flex-row justify-content-between align-items-center h-100">
                <a href="/" class="fw-bold fs-4 link-body-emphasis text-decoration-none">CATALOGO</a>
                <nav>
                    <a href="/" class="me-3 link-body-emphasis text-decoration-none">Home</a>
                    <a href="/logs" class="me-3 link-body-emphasis text-decoration-none">Logs</a>
                </nav>
            </div>
        </header>

        <main class="mx-3">
            <?php include_once __DIR__ . "/$page_name.php" ?>
        </main>

        <script async src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>
</html>
