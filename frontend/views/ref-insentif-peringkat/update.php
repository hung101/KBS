<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefInsentifPeringkat */

$this->title = 'Update Ref Insentif Peringkat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Insentif Peringkats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-insentif-peringkat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
