<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanSukanSpesifik */

$this->title = 'Update Ref Kelulusan Sukan Spesifik: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Sukan Spesifiks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kelulusan-sukan-spesifik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
