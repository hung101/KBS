<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MaklumatPegawaiTeknikal */

$this->title = GeneralLabel::maklumat_pegawai_teknikal_paparan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_pegawai_teknikal, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-pegawai-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelMaklumatPegawaiTeknikalKejohanan' => $searchModelMaklumatPegawaiTeknikalKejohanan,
        'dataProviderMaklumatPegawaiTeknikalKejohanan' => $dataProviderMaklumatPegawaiTeknikalKejohanan,
        'readonly' => $readonly,
    ]) ?>

</div>
