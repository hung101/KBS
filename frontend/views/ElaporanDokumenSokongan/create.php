<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanDokumenSokongan */

$this->title = 'Tambah e-Laporan Dokumen Sokongan';
$this->params['breadcrumbs'][] = ['label' => 'e-Laporan Dokumen Sokongan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-dokumen-sokongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
