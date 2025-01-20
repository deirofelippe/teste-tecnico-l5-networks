<div class="container mb-5">
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 text-center">
    <?php foreach ($data as $index => $film) { ?>
      <div class="col gy-4 ">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title h-50"><?=$film['title'] ?></h1>
            <p class="card-subtitle h-25 d-flex flex-center"><?=$film['release_date'] ?></p>
            <a class="btn btn-secondary h-25 w-100" href="/films/<?=$film['id'] ?>">Ver detalhes</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
