<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPencalonanKepimpinanSukanJawatan */

$this->title = 'Create Anugerah Pencalonan Lain Jawatan';
$this->params['breadcrumbs'][] = ['label' => 'Anugerah Pencalonan Lain Jawatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pencalonan-lain-jawatan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
