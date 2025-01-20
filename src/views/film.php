<div class="container">
  <div>
    <h1><?=$data['title'] ?></h1>
    <p><span class="fw-medium">Episódio:</span>
      <?=$data['episode'] ?>
    </p>
    <p><span class="fw-medium">Data de lançamento:</span>
      <?=$data['release_date'] ?>
    </p>
    <p><span class="fw-medium">Diretores(as):</span>
      <?=$data['director'] ?>
    </p>
    <p><span class="fw-medium">Produtores(as):</span>
      <?=$data['producer'] ?>
    </p>
    <p><span class="fw-medium">Idade do filme:</span>
      <?=$data['film_age'] ?>
    </p>
    <p><span class="fw-medium">Personagens:</span>
      <?php foreach ($data['characters'] as $index => $character) { ?>
      <a class="btn btn-secondary rounded-pill link-character"
        href="#">
        <?=$character['name'] ?> </a>
      <?php } ?>
    </p>
    <p><span class="fw-medium">Sinopse:</span>
    <p><?=$data['opening_crawl'] ?></p>
    </p>
  </div>

  <div class="d-flex flex-center">
    <div class="divisor"></div>
  </div>
  
  <div class="comments_section mb-5">
    <h2>Comentários (<span id="total-comments"><?= $data['total_comments']?></span>)</h2>

    <form id="comment-form" class="mb-5" method="post">
      <input type="hidden" name="film_id" id="film_id" value="<?=$data['id']?>">
      <input type="hidden" name="film_name" id="film_name" value="<?=$data['title']?>">

      <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" name="name" class="form-control" id="name" aria-describedby="name">
      </div>

      <div class="mb-3">
        <label for="comment" class="form-label">Comentário</label>
        <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
      </div>

      <button type="submit" class="btn btn-secondary">Submit</button>
    </form>
  
    <div id="comments-list" class="comments-list">
      <?php foreach ($data['comments'] as $index => $comment) { ?>
        <div class="card mb-3 comments-item">
          <div class="card-header">
            <span class="fs-3"><?= $comment['author']?></span> - <?= $comment['date']?>
          </div>
          <div class="card-body">
            <p class="card-text"><?= $comment['comment']?></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $("#comment-form").submit(function(event){
      event.preventDefault();

      const film_id = $('input[name="film_id"]').val();
      const film_name = $('input[name="film_name"]').val();
      const author = $('input[name="name"]').val();
      const comment = $('textarea[name="comment"]').val();
      
      const url = "<?=$backend_url?>/comments";
      const body = {
        "film_id": film_id,
        "film_name": film_name,
        "author": author,
        "comment": comment,
      };

      $.ajax({
        url: url,
        method: "POST",
        data: JSON.stringify(body),
        headers: {
          "Content-Type": "application/json",
        }
      })  
      .done(function(data) {
        const html = `
        <div class="card mb-3 comments-item">
          <div class="card-header">
            <span class="fs-3">${data.author} (Você)</span> - ${data.date}
          </div>
          <div class="card-body">
            <p class="card-text">${data.comment}</p>
          </div>
        </div>
        `;

        $("#comments-list").prepend(html);

        $('input[name="name"]').val("");
        $('textarea[name="comment"]').val("");

        let total_comments = $('#total-comments').text();
        total_comments = parseInt(total_comments) + 1

        $('#total-comments').text(total_comments);
        
      })
      .fail(function() {
        console.log("Erro ao criar comentário");
      });
    });
  });
</script>