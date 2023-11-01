<div class="mb-2 text-right">
    <a class="btn btn-success" href="<?= route('process.php?action=create') ?>">Novo processo</a>
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
                <?php includeWithVariables(view('process/list.php'), ['rows' => $rows]) ?>
            </div>
        </div>
    </div>
</div>
