<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::perubatan.': ' . ' ' . $model->perubatan_id;
$this->title = GeneralLabel::perubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_perubatans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->perubatan_id, 'url' => ['view', 'id' => $model->perubatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-perubatan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
