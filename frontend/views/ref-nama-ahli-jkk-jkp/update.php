<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefNamaAhliJkkJkp */

$this->title = 'Update Ref Nama Ahli Jkk Jkp: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Ahli Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-nama-ahli-jkk-jkp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
