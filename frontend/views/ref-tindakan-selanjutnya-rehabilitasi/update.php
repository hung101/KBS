<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefTindakanSelanjutnyaRehabilitasi */

$this->title = 'Update Ref Tindakan Selanjutnya Rehabilitasi: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Tindakan Selanjutnya Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-tindakan-selanjutnya-rehabilitasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
