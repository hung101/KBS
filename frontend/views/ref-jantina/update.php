<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJantina */

$this->title = 'Update Ref Jantina: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jantinas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jantina-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
