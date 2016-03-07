<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KeputusanUjianSaringan */

$this->title = 'Update Keputusan Ujian Saringan: ' . ' ' . $model->keputusan_ujian_saringan_id;
$this->params['breadcrumbs'][] = ['label' => 'Keputusan Ujian Saringans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->keputusan_ujian_saringan_id, 'url' => ['view', 'id' => $model->keputusan_ujian_saringan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="keputusan-ujian-saringan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
