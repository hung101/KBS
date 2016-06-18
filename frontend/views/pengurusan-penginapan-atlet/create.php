<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenginapanAtlet */

$this->title = 'Create Pengurusan Penginapan Atlet';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Penginapan Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penginapan-atlet-create">

   <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
