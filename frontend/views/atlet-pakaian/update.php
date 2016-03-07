<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPakaian */

//$this->title = 'Update Atlet Pakaian: ' . ' ' . $model->pakaian_id;
$this->title = GeneralLabel::updateTitle . ' Pakaian Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Pakaian Sukan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Pakaian Sukan', 'url' => ['view', 'id' => $model->pakaian_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pakaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
