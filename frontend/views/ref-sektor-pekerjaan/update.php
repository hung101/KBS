<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSektorPekerjaan */

$this->title = 'Update Ref Sektor Pekerjaan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sektor Pekerjaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sektor-pekerjaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
