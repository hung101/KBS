<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPesertaSukan */

$this->title = 'Update Penganjuran Kursus Peserta Sukan: ' . ' ' . $model->penganjuran_kursus_peserta_sukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus Peserta Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penganjuran_kursus_peserta_sukan_id, 'url' => ['view', 'id' => $model->penganjuran_kursus_peserta_sukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penganjuran-kursus-peserta-sukan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
