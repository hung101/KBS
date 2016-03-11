<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanFisiologi */

$this->title = 'Update Ref Perkhidmatan Fisiologi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Perkhidmatan Fisiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-perkhidmatan-fisiologi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
