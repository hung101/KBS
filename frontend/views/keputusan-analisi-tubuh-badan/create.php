<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\KeputusanAnalisiTubuhBadan */

$this->title = GeneralLabel::createTitle . ' Keputusan Analisi Tubuh Badan';
$this->params['breadcrumbs'][] = ['label' => 'Keputusan Analisi Tubuh Badan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keputusan-analisi-tubuh-badan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
