<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanPasukanPemain */

$this->title = 'Update Anugerah Pencalonan Pasukan Pemain: ' . $model->anugerah_pencalonan_pasukan_pemain_id;
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pencalonan Pasukan Pemains', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anugerah_pencalonan_pasukan_pemain_id, 'url' => ['view', 'id' => $model->anugerah_pencalonan_pasukan_pemain_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anugerah-pencalonan-pasukan-pemain-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
