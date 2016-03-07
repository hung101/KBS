<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerkhidmatanPermakanan */

//$this->title = 'Update Permohonan Perkhidmatan Permakanan: ' . ' ' . $model->permohonan_perkhidmatan_permakanan_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Perkhidmatan Permakanan';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Perkhidmatan Permakanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Perkhidmatan Permakanan', 'url' => ['view', 'id' => $model->permohonan_perkhidmatan_permakanan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perkhidmatan-permakanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
