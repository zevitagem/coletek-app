<?php
if (!empty($message)) {
    echo $message;
}
?>

<div class="row">
    <div class="col-6">
        <form method="GET" action="<?= route('user.php?action=index') ?>">
            <div class="input-group">
                <select class="custom-select form-control" name="setor">
                    <option value="0">Selecione um setor para filtro</option>
                    <?php
                    $setorFiltrado = '';
                    foreach ($data['setores'] as $setor) {
                        $setorId = $setor->getPrimaryValue();
                        $setorName = $setor->getName();
                        $selected = (isset($data['params']['setor']) && $data['params']['setor'] == $setorId) ? 'selected' : '';
                        if (!empty($selected)) {
                            $setorFiltrado = $setorName;
                        }
                        ?>
                        <option <?= $selected ?> value="<?= $setor->getPrimaryValue() ?>"><?= $setor->getName() ?></option>
                    <?php } ?>
                </select>
                <div class="input-group-append">
                    <button class="btn-sm btn btn-outline-secondary" type="submit">Filtrar</button>
                </div>
            </div>
            <?php if (!empty($setorFiltrado)) {
                ?>
                <span class="badge badge-secondary text-uppercase">Filtrado pelo setor: <?= $setorFiltrado ?></span>
                <?php }
            ?>
        </form>
    </div>
    <div class="col-6 text-right">
        <a class="btn btn-success" href="<?= route('user.php?action=create') ?>">Novo usuário</a>
    </div>
</div>
<div class="mb-2 text-right">

</div>

<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#list-tab" role="tab" aria-controls="profile" aria-selected="true">Lista</a>
            </li>
        </ul>
        <div class="tab-content"><br>
            <div class="tab-pane fade show active" id="list-tab" role="tabpanel" aria-labelledby="list-tab">
                <?php includeWithVariables(view('user/list.php'), ['rows' => $data['rows'] ?? []]) ?>
            </div>
        </div>
    </div>
</div>
