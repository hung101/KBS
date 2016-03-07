<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik */

//$this->title = 'Update Permohonan Perkhidmatan Analisa Perlawanan Dan Bimekanik: ' . ' ' . $model->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id;
$this->title = GeneralLabel::updateTitle . ' Permohonan Perkhidmatan Analisa Perlawanan Dan Biomekanik';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Perkhidmatan Analisa Perlawanan Dan Biomekanik', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Permohonan Perkhidmatan Analisa Perlawanan Dan Biomekanik', 'url' => ['view', 'id' => $model->permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
