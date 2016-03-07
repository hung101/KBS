<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletOku */

//$this->title = 'Update Atlet Oku: ' . ' ' . $model->oku_id;
$this->title = GeneralLabel::updateTitle . ' OKU';
$this->params['breadcrumbs'][] = ['label' => 'OKU', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' OKU', 'url' => ['view', 'id' => $model->oku_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-oku-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
