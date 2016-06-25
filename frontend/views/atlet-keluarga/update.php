<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKeluarga */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_keluarga.': ' . ' ' . $model->keluarga_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::keluarga;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::keluarga, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::keluarga, 'url' => ['view', 'id' => $model->keluarga_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-keluarga-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
