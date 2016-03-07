<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPerhimpunanKemKos */

$this->title = 'Update Pengurusan Perhimpunan Kem Kos: ' . ' ' . $model->pengurusan_perhimpunan_kem_kos_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Perhimpunan Kem Kos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_perhimpunan_kem_kos_id, 'url' => ['view', 'id' => $model->pengurusan_perhimpunan_kem_kos_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-perhimpunan-kem-kos-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
