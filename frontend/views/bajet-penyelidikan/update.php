<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BajetPenyelidikan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bajet_penyelidikan.': ' . ' ' . $model->bajet_penyelidikan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::bajet_penyelidikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bajet_penyelidikan_id, 'url' => ['view', 'id' => $model->bajet_penyelidikan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bajet-penyelidikan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
