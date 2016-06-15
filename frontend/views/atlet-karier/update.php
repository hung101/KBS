<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKarier */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_karier.': ' . ' ' . $model->karier_atlet_id;
$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::karier;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_kariers, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->karier_atlet_id, 'url' => ['view', 'id' => $model->karier_atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-karier-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
