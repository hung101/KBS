<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanKursusPersatuanPenasihat */

$this->title = 'Update Pengurusan Permohonan Kursus Persatuan Penasihat: ' . $model->pengurusan_permohonan_kursus_persatuan_penasihat_id;
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Permohonan Kursus Persatuan Penasihats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pengurusan_permohonan_kursus_persatuan_penasihat_id, 'url' => ['view', 'id' => $model->pengurusan_permohonan_kursus_persatuan_penasihat_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengurusan-permohonan-kursus-persatuan-penasihat-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
