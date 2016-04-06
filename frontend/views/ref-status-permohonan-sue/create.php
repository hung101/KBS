<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanSue */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Permohonan Sue';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Sues', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-sue-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
