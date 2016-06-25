<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanLain */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_pencalonan_lain;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_lain, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-lain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelAnugerahPencalonanLainJawatan' => $searchModelAnugerahPencalonanLainJawatan,
        'dataProviderAnugerahPencalonanLainJawatan' => $dataProviderAnugerahPencalonanLainJawatan,
        'readonly' => $readonly,
    ]) ?>

</div>
