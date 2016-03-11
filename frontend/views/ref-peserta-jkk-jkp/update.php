<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPesertaJkkJkp */

$this->title = 'Update Ref Peserta Jkk Jkp: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Peserta Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-peserta-jkk-jkp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
