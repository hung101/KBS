<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikSubjek */

$this->title = 'Update Maklumat Akademik Subjek: ' . $model->maklumat_akademik_subjek_id;
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Akademik Subjeks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->maklumat_akademik_subjek_id, 'url' => ['view', 'id' => $model->maklumat_akademik_subjek_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maklumat-akademik-subjek-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
