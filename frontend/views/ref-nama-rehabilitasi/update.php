<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefNamaRehabilitasi */

$this->title = 'Update Ref Nama Rehabilitasi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-nama-rehabilitasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
