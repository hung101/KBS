<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPerubatanSejarah */

//$this->title = 'Update Atlet Perubatan Sejarah: ' . ' ' . $model->sejarah_perubatan_id;
$this->title = GeneralLabel::updateTitle . 'Sejarah Perubatan';
$this->params['breadcrumbs'][] = ['label' => 'Sejarah Perubatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sejarah_perubatan_id, 'url' => ['view', 'id' => $model->sejarah_perubatan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-perubatan-sejarah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
