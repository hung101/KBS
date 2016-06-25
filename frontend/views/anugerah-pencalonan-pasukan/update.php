<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanPasukan */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::anugerah_pencalonan_pasukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_pasukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_pencalonan_pasukan, 'url' => ['view', 'id' => $model->anugerah_pencalonan_pasukan_id]];
$this->params['breadcrumbs'][] = $this->title;
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
