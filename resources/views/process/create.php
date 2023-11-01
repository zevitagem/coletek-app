<div id="message-box"></div>

<form id="process-form" action="<?= route('process.php?action=store') ?>" method="POST">
    <?php includeWithVariables(view('process/content-form.php'), $data) ?>
</form>
