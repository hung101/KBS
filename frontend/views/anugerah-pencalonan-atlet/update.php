<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanAtlet */

//$this->title = 'Update Anugerah Pencalonan Atlet: ' . ' ' . $model->anugerah_pencalonan_atlet;
$this->title = GeneralLabel::updateTitle . ' Anugerah Pencalonan Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pencalonan Atlet', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Anugerah Pencalonan Atlet', 'url' => ['view', 'id' => $model->anugerah_pencalonan_atlet]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
