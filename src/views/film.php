<div class="container">
  <div>
    <h1><?=$data['title'] ?></h1>
    <p><span class="fw-medium">Episódio:</span> <?=$data['episode'] ?></p>
    <p><span class="fw-medium">Data de lançamento:</span> <?=$data['release_date'] ?></p>
    <p><span class="fw-medium">Diretores(as):</span> <?=$data['director'] ?></p>
    <p><span class="fw-medium">Produtores(as):</span> <?=$data['producer'] ?></p>
    <p><span class="fw-medium">Idade do filme:</span> <?=$data['film_age'] ?></p>
    <p><span class="fw-medium">Personagens:</span> 
      <?php foreach ($data['characters'] as $index => $character) { ?>
        <a class="btn btn-secondary rounded-pill link-character" href="/character/<?=$character['id'] ?>"> <?=$character['name'] ?> </a>
      <?php } ?>
    </p>
    <p><span class="fw-medium">Sinopse:</span> <p><?=$data['opening_crawl'] ?></p></p>
  </div>
</div>