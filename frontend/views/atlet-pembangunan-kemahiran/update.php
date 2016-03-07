<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKemahiran */

//$this->title = 'Update Atlet Pembangunan Kemahiran: ' . ' ' . $model->kemahiran_id;
$this->title = GeneralLabel::updateTitle . ' Kemahiran';
$this->params['breadcrumbs'][] = ['label' => 'Kemahiran', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Kemahiran', 'url' => ['view', 'id' => $model->kemahiran_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pembangunan-kemahiran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
