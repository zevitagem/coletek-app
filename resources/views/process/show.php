<div id="box-notices"></div>

<?php if (empty($data['process'])) { ?>
    <div class="alert alert-danger">O registro não foi encontrado, volte para a página anterior, por favor.</div>
<?php } else { ?>
    <form id="process-form" action="<?= route('process.php?action=update') ?>" method="PUT">
        <?php includeWithVariables(view('process/content-form.php'), $data) ?>
    </form>
<?php } ?>
