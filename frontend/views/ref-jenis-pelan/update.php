<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisPelan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jenis_pelan.': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_pelan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-pelan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
