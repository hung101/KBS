<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefRawatanRehabilitasi */

$this->title = 'Update Ref Rawatan Rehabilitasi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Rawatan Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-rawatan-rehabilitasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>