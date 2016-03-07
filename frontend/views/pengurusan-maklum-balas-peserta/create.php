<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanMaklumBalasPeserta */

$this->title = GeneralLabel::createTitle . ' Kehadiran Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Kehadiran Peserta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-maklum-balas-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanSoalanMaklumBalasPeserta' => $searchModelPengurusanSoalanMaklumBalasPeserta,
        'dataProviderPengurusanSoalanMaklumBalasPeserta' => $dataProviderPengurusanSoalanMaklumBalasPeserta,
        'readonly' => $readonly,
    ]) ?>

</div>
