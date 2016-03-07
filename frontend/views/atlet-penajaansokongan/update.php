<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPenajaansokongan */

//$this->title = 'Update Atlet Penajaansokongan: ' . ' ' . $model->penajaan_sokongan_id;
$this->title = 'Penajaan';
$this->params['breadcrumbs'][] = ['label' => 'Atlet Penajaansokongans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penajaan_sokongan_id, 'url' => ['view', 'id' => $model->penajaan_sokongan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-penajaansokongan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
