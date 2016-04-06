<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik */

$this->title = GeneralLabel::createTitle . ' Permohonan Perkhidmatan Analisa Perlawanan Dan Biomekanik';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_perkhidmatan_analisa_perlawanan_dan_biomekanik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-perkhidmatan-analisa-perlawanan-dan-bimekanik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
