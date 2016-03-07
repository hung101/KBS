<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BajetPenyelidikan */

$this->title = 'Update Bajet Penyelidikan: ' . ' ' . $model->bajet_penyelidikan_id;
$this->params['breadcrumbs'][] = ['label' => 'Bajet Penyelidikans', 'url' => ['index']];
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
