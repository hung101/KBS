<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanTokohSukan */

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::anugerah_pencalonan_tokoh_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_tokoh_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::anugerah_pencalonan_tokoh_sukan, 'url' => ['view', 'id' => $model->anugerah_pencalonan_lain_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-lain-update">

    <h1><?= Html::encode($this->title) ?></h1>

   <?= $this->render('_form', [
        'model' => $model,
       'searchModelAnugerahPencalonanTokohSukanJawatan' => $searchModelAnugerahPencalonanTokohSukanJawatan,
        'dataProviderAnugerahPencalonanTokohSukanJawatan' => $dataProviderAnugerahPencalonanTokohSukanJawatan,
        'readonly' => $readonly,
    ]) ?>

</div>
