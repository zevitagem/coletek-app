<div id="message-box"></div>

<form id="user-form" action="<?= route('user.php?action=store') ?>" method="POST">
    <?php includeWithVariables(view('user/content-form.php'), $data) ?>
</form>

<?php includeWithVariables(view('user/vinculo/template-vinculo.php')) ?>
