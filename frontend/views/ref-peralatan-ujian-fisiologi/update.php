<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeralatanUjianFisiologi */

$this->title = 'Update Ref Peralatan Ujian Fisiologi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Peralatan Ujian Fisiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-peralatan-ujian-fisiologi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
