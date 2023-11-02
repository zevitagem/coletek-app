<?php if (empty($rows)) { ?>
    <div class="alert alert-danger">Nenhum registro para ser visualizado</div>
<?php } else { ?>
    <table id="user" class="table-responsive table table-bordered table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Quantidade de setores</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row) {
                $id = $row->getAttribute('users_id')
                ?>
                <tr>
                    <td><?= $id ?></td>
                    <td><?= $row->getAttribute('users_name') ?></td>
                    <td><?= $row->getAttribute('users_email') ?></td>
                    <td><?= $row->getAttribute('total_setores') ?></td>
                    <td class="text-center">
                        <a class="btn btn-primary btn-sm" href="<?= route('user.php?action=show&id=' . $id) ?>">
                            <i class="feather icon-search"></i>
                        </a>
                        <button class="btn btn-danger btn-sm"><i class="feather icon-trash"></i></button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
