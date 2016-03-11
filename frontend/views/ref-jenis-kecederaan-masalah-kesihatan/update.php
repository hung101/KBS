<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKecederaanMasalahKesihatan */

$this->title = 'Update Ref Jenis Kecederaan Masalah Kesihatan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kecederaan Masalah Kesihatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-kecederaan-masalah-kesihatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
