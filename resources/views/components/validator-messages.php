<?php if (!empty($messages)) { ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php foreach ($messages as $message) { ?>
                <li><?= $message ?></li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>
