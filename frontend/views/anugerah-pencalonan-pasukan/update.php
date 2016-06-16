<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanPasukan */

$this->title = 'Update Anugerah Pencalonan Pasukan: ' . $model->anugerah_pencalonan_pasukan_id;
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pencalonan Pasukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anugerah_pencalonan_pasukan_id, 'url' => ['view', 'id' => $model->anugerah_pencalonan_pasukan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="anugerah-pencalonan-pasukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelAnugerahPencalonanPasukanPemain' => $searchModelAnugerahPencalonanPasukanPemain,
        'dataProviderAnugerahPencalonanPasukanPemain' => $dataProviderAnugerahPencalonanPasukanPemain,
        'readonly' => $readonly,
    ]) ?>

</div>
