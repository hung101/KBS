<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiFisioterapi */

$this->title = 'Update Ref Status Temujanji Fisioterapi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Temujanji Fisioterapis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-temujanji-fisioterapi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
