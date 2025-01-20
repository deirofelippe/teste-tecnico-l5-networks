<div class="container table-responsive">
  <table class="table table-striped logs-table">
    <thead>
      <tr>
        <th scope="col" style="width: 18%">Data</th>
        <th scope="col" style="width: 8%">Level</th>
        <th scope="col" style="width: 10%">Contexto</th>
        <th scope="col" style="width: 64%">Descrição</th>
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
</div>

<div class="fixed-bottom d-flex flex-row flex-center pagination border">
  <a class="text-decoration-none" href="/logs?limit=<?=$data['limit'] ?>&offset=<?=$data['previous'] ?>">Anterior</a>
  <span class="px-3">
    <?=$data['offset'] ?> de <?=$data['total_logs'] ?> logs
  </span>
  <a class="text-decoration-none" href="/logs?limit=<?=$data['limit'] ?>&offset=<?=$data['next'] ?>">Próximo</a>
</div>
