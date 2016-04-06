<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KeputusanAnalisiTubuhBadan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::keputusan_analisi_tubuh_badan.': ' . ' ' . $model->keputusan_analisi_tubuh_badan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::keputusan_analisi_tubuh_badan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->keputusan_analisi_tubuh_badan_id, 'url' => ['view', 'id' => $model->keputusan_analisi_tubuh_badan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="keputusan-analisi-tubuh-badan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
