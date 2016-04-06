<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanBiasiswa */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_biasiswa.': ' . ' ' . $model->permohonan_biasiswa_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::permohonan_biasiswa;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_biasiswa, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::permohonan_biasiswa, 'url' => ['view', 'id' => $model->permohonan_biasiswa_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-biasiswa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
