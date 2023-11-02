<?php
if (!empty($message)) {
    echo $message;
}
?>

<?php if (empty($data['row'])) { ?>
    <div class="alert alert-danger">O registro não foi encontrado, volte para a página anterior, por favor.</div>
<?php } else { ?>
    <form id="user-form" action="<?= route('user.php?action=update') ?>" method="POST">
        <input value="<?= $data['row']->getPrimaryValue() ?>" name="id" type="hidden"/>
        <?php includeWithVariables(view('user/content-form.php'), $data) ?>
    </form>

    <?php includeWithVariables(view('user/vinculo/template-vinculo.php')) ?>
<?php } ?>
