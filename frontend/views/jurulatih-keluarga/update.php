<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\JurulatihKeluarga delete() findOne */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::jurulatih_keluarga.': ' . ' ' . $model->jurulatih_keluarga_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::maklumat_keluarga;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_keluarga, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::maklumat_keluarga, 'url' => ['view', 'id' => $model->jurulatih_keluarga_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jurulatih-keluarga-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
