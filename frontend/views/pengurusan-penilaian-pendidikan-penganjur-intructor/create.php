<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianPendidikanPenganjurIntructor */

$this->title = GeneralLabel::createTitle . ' Pengurusan Penilaian Pendidikan Penganjur/Intructor';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Penilaian Pendidikan Penganjur/Intructor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penilaian-pendidikan-penganjur-intructor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanSoalanPenilaianPendidikan' => $searchModelPengurusanSoalanPenilaianPendidikan,
        'dataProviderPengurusanSoalanPenilaianPendidikan' => $dataProviderPengurusanSoalanPenilaianPendidikan,
        'readonly' => $readonly,
    ]) ?>

</div>
