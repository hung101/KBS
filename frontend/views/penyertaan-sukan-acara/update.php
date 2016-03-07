<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanAcara */

$this->title = 'Update Penyertaan Sukan Acara: ' . ' ' . $model->penyertaan_sukan_acara_id;
$this->params['breadcrumbs'][] = ['label' => 'Penyertaan Sukan Acaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penyertaan_sukan_acara_id, 'url' => ['view', 'id' => $model->penyertaan_sukan_acara_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penyertaan-sukan-acara-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
