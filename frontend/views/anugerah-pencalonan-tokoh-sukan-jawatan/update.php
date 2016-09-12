<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanTokohSukanJawatan */

$this->title = 'Update Anugerah Pencalonan Lain Jawatan: ' . $model->anugerah_pencalonan_lain_jawatan_id;
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pencalonan Lain Jawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anugerah_pencalonan_lain_jawatan_id, 'url' => ['view', 'id' => $model->anugerah_pencalonan_lain_jawatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anugerah-pencalonan-lain-jawatan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
