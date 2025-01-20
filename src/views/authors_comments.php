<div class="container">
  <div class="accordion" id="accordion-flush">

    <?php foreach ($data as $index => $author) { ?>
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#flush-collapse-<?=$author['author_id']?>"
          aria-expanded="false"
          aria-controls="flush-collapse-<?=$author['author_id']?>">

          <span
            class="fs-4"><?= $author['author_name']?></span>
          <span class="mx-1">-</span>
          <span
            class="fs-6"><?= $author['total_comments'] . ' comentário(s)'?></span>

        </button>
      </h2>

      <div
        id="flush-collapse-<?=$author['author_id']?>"
        class="accordion-collapse collapse" data-bs-parent="#accordion-flush">
        <div class="accordion-body">

          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col" style="width: 30%">Nome do filme</th>
                <th scope="col" style="width: 20%">Data</th>
                <th scope="col" style="width: 50%">Comentário</th>
              </tr>
            </thead>

            <tbody>

              <?php foreach ($author['comments'] as $index => $comment) { ?>
              <tr>
                <td><a
                    href="/films/<?=$comment['film_id']?>"><?= $comment['film_name']?></a>
                </td>
                <td><?= $comment['date']?></td>
                <td><?= $comment['comment']?>
                </td>
              </tr>
              <?php } ?>

            </tbody>
          </table>

        </div>
      </div>
    </div>
    <?php } ?>

  </div>
</div>