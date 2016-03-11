<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefLatarbelakangKes */

$this->title = 'Update Ref Latarbelakang Kes: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Latarbelakang Kes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-latarbelakang-kes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
