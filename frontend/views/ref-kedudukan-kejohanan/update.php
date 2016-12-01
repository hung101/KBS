<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefKedudukanKejohanan */

$this->title = 'Update Ref Kedudukan Kejohanan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Kedudukan Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-kedudukan-kejohanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>