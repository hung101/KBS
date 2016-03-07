<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TempahanKursusPersatuan */

$this->title = 'Update Tempahan Kursus Persatuan: ' . ' ' . $model->tempahan_kursus_persatuan_id;
$this->params['breadcrumbs'][] = ['label' => 'Tempahan Kursus Persatuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tempahan_kursus_persatuan_id, 'url' => ['view', 'id' => $model->tempahan_kursus_persatuan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tempahan-kursus-persatuan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
