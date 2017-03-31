<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatAkademikJadual */

$this->title = 'Update Maklumat Akademik Jadual: ' . $model->maklumat_akademik_jadual_id;
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Akademik Jaduals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->maklumat_akademik_jadual_id, 'url' => ['view', 'id' => $model->maklumat_akademik_jadual_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="maklumat-akademik-jadual-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
