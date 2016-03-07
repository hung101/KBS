<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaobsPenganjuranSumberKewangan */

$this->title = 'Update Paobs Penganjuran Sumber Kewangan: ' . ' ' . $model->paobs_penganjuran_sumber_kewangan_id;
$this->params['breadcrumbs'][] = ['label' => 'Paobs Penganjuran Sumber Kewangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->paobs_penganjuran_sumber_kewangan_id, 'url' => ['view', 'id' => $model->paobs_penganjuran_sumber_kewangan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="paobs-penganjuran-sumber-kewangan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
