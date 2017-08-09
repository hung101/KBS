<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisMaklumatPusatLatihan */

$this->title = 'Update Ref Jenis Maklumat Pusat Latihan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Maklumat Pusat Latihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-maklumat-pusat-latihan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
