<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanPasukanPemain */

$this->title = 'Create Anugerah Pencalonan Pasukan Pemain';
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pencalonan Pasukan Pemains', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-pasukan-pemain-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
