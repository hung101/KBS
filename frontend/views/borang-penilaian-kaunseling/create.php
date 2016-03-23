<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangPenilaianKaunseling */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::laporan_sesi_kaunseling;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::laporan_sesi_kaunseling, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-penilaian-kaunseling-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
