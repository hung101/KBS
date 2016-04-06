<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPermohonanMembaikiPeralatan */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Permohonan Membaiki Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Permohonan Membaiki Peralatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-membaiki-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
