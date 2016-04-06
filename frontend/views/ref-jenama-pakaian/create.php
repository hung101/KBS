<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenamaPakaian */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenama Pakaian';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenama Pakaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenama-pakaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
