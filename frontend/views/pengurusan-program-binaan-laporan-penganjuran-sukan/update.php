<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanAtlet */

$this->title = 'Update Pengurusan Program Binaan Atlet: ' . $model->laporan_penganjuran_sukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Program Binaan Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->laporan_penganjuran_sukan_id, 'url' => ['view', 'id' => $model->laporan_penganjuran_sukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-program-binaan-sukan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
