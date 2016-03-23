<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanAtlet */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_pencalonan_atlet;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pencalonan_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-atlet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
