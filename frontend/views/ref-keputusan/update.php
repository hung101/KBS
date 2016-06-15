<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKeputusan */

$this->title = 'Update Ref Keputusan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Keputusans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-keputusan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
