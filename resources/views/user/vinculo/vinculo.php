<div class="setor">
    <div class="row">
        <div class="col-6">
            <label class="mb-0"><?= (empty($name)) ? '' : $name ?></label>
        </div>
        <div class="col-6 text-right">
            <button class="remove btn btn-danger btn-sm">[Excluir]</button>
            <input type="hidden" name="setor-adicionado[]" value="<?= (empty($id)) ? '' : $id ?>"/>
        </div>
    </div>
</div>
