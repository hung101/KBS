<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatELaporan */

$this->title = 'Update Ref Peringkat Elaporan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Elaporans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-peringkat-elaporan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
