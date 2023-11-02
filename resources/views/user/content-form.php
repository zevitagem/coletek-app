<?php $isUpdate = (!empty($row)); ?>

<table class="table table-bordered">
    <tbody>
        <tr>
            <td>Nome</td> 
            <td>
                <div class="form-group">
                    <input type="text" maxlength="100" required class="form-control" name="name" value="<?= ($isUpdate) ? $row->getName() : '' ?>">
                </div>
            </td> 
        </tr>
        <tr>
            <td>Email</td> 
            <td>
                <div class="form-group">
                    <input type="email" maxlength="100" required class="form-control" name="email" value="<?= ($isUpdate) ? $row->getEmail() : '' ?>">
                </div>
            </td> 
        </tr>
        <tr>
            <td>Setores</td> 
            <td>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <select class="custom-select form-control" id="setor">
                            <option value="0">Selecione um setor</option>
                            <?php foreach ($setores as $setor) { ?>
                                <option value="<?= $setor->getPrimaryValue() ?>"><?= $setor->getName() ?></option>
                            <?php } ?>
                        </select>
                        <div class="input-group-append">
                            <button id="add-setor" class="btn btn-primary btn-sm"><i class="feather icon-plus"></i>Adicionar setor</button>
                        </div>
                    </div>
                </div>
            </td> 
        </tr>
        <tr>
            <td id="setores-adicionados-box" colspan="2">
                <?php
                if ($isUpdate && !empty($setores_adicionados)) {
                    foreach ($setores_adicionados as $setorAdicionado) {
                        includeWithVariables(view('user/vinculo/vinculo.php'), [
                            'name' => $setorAdicionado->getAttribute('setor_name'),
                            'id' => $setorAdicionado->getAttribute('setor_id')]
                        );
                    }
                }
                ?>
            </td>
        </tr>
    </tbody>
</table>

<button type="submit" data-style="expand-right" type="button" class="btn btn-success ladda-button">
    <i class="feather icon-plus"></i><span class="ladda-label">Gravar</span> 
</button>
