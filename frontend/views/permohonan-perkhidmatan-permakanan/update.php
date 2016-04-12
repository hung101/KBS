<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerkhidmatanPermakanan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_perkhidmatan_permakanan.': ' . ' ' . $model->permohonan_perkhidmatan_permakanan_id;
$this->title = GeneralLabel::updateTitle .' '.GeneralLabel::permohonan_perkhidmatan_permakanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_perkhidmatan_permakanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle .' '.GeneralLabel::permohonan_perkhidmatan_permakanan, 'url' => ['view', 'id' => $model->permohonan_perkhidmatan_permakanan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perkhidmatan-permakanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
