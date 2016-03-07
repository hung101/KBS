<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefBandar */

$this->title = 'Update Ref Bandar: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Bandars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-bandar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
