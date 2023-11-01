<?php $isUpdate = (!empty($process)); ?>

<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Nome</td> 
            <td>
                <div class="form-group">
                    <input <?= ($isUpdate) ? 'disabled' : '' ?> type="text" class="form-control" name="name" value="<?= ($isUpdate) ? $process->getName() : '' ?>">
                </div>
            </td> 
        </tr>
        <tr>
            <td>Pessoas</td> 
            <td>
                <div class="form-group">
                    <select class="form-control" name="people" <?= ($isUpdate) ? 'disabled' : '' ?>>
                        <option value="0">Selecione uma pessoa</option>
                        <?php foreach ($people as $person) { ?>
                            <option value="<?= $person->getPrimaryValue() ?>" <?= ($isUpdate && $person->getPrimaryValue() == $process->getAttribute('people_id')) ? 'selected' : '' ?>><?= $person->getName() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </td> 
        </tr>
        <tr>
            <td>Unidades</td> 
            <td>
                <div class="form-group">
                    <select class="form-control" name="unity" <?= ($isUpdate) ? 'disabled' : '' ?>>
                        <option value="0">Selecione uma unidade</option>
                        <?php foreach ($unities as $unity) { ?>
                            <option value="<?= $unity->getPrimaryValue() ?>" <?= ($isUpdate && $unity->getPrimaryValue() == $process->getAttribute('unity_id')) ? 'selected' : '' ?>><?= $unity->getDescription() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </td> 
        </tr>
        <tr>
            <td>Status</td> 
            <td>
                <div class="form-group">
                    <select class="form-control" name="status">
                        <option value="0">Selecione uma status</option>
                        <?php foreach ($status as $statusRow) { ?>
                            <option value="<?= $statusRow->getPrimaryValue() ?>" <?= ($isUpdate && $statusRow->getPrimaryValue() == $process->getAttribute('status')) ? 'selected' : '' ?>><?= $statusRow->getDescription() ?></option>
                        <?php } ?>
                    </select>
                </div>
            </td> 
        </tr>
    </tbody>
</table>

<button type="submit" data-style="expand-right" type="button" class="btn btn-success ladda-button">
    <i class="feather icon-plus"></i><span class="ladda-label">Gravar</span> 
</button>
