<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefTahapAkademikPegawaiTeknikal */

$this->title = 'Update Ref Tahap Akademik Pegawai Teknikal: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Akademik Pegawai Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-tahap-akademik-pegawai-teknikal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>