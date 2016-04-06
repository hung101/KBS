<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SenaraiAtlet */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::senarai_atlet.': ' . ' ' . $model->senarai_atlet_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::senarai_atlet, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_atlet_id, 'url' => ['view', 'id' => $model->senarai_atlet_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="senarai-atlet-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
