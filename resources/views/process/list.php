<?php if (empty($rows)) { ?>
    <div class="alert alert-danger">Nenhum registro para ser visualizado</div>
<?php } else { ?>
    <table id="process" class="table-responsive table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Pessoa</th>
                <th>Unidade</th>
                <th>Status</th>
                <th>Data criação</th>
                <th>Data modificação</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td><?= $row->getPrimaryValue() ?></td>
                    <td><?= $row->getName() ?></td>
                    <td><?= $row->getAttribute('people_name') ?></td>
                    <td><?= $row->getAttribute('unity_description') ?></td>
                    <td><?= $row->getAttribute('status_description') ?></td>
                    <td><?= formatDatetimeToBR($row->getAttribute('created_at')) ?></td>
                    <td><?= formatDatetimeToBR($row->getAttribute('updated_at')) ?></td>
                    <td class="text-center">
                        <a href="<?= route('process.php?action=show&id=' . $row->getPrimaryValue()) ?>">
                            <i class="feather icon-search"></i>
                        </a>
                        <i class="feather icon-trash"></i>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
