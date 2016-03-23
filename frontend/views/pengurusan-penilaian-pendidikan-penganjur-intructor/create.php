<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenilaianPendidikanPenganjurIntructor */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_penilaian_pendidikan_penganjurintructor;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penilaian_pendidikan_penganjurintructor, 'url' => ['index']];
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
