<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianRekods */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_pencapaian_rekods.': ' . ' ' . $model->pencapaian_rekods_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_pencapaian_rekods, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pencapaian_rekods_id, 'url' => ['view', 'id' => $model->pencapaian_rekods_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-pencapaian-rekods-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
