<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefTawaranAtlet */

$this->title = 'Update Ref Tawaran Atlet: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Tawaran Atlets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-tawaran-atlet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>