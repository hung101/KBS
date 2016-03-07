<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanPentadbiranPejabat */

//$this->title = 'Update Bantuan Pentadbiran Pejabat: ' . ' ' . $model->bantuan_pentadbiran_pejabat_id;
$this->title = GeneralLabel::updateTitle . ' Bantuan Pentadbiran Pejabat';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Pentadbiran Pejabat', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Bantuan Pentadbiran Pejabat', 'url' => ['view', 'id' => $model->bantuan_pentadbiran_pejabat_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-pentadbiran-pejabat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInformasiPermohonan' => $searchModelInformasiPermohonan,
        'dataProviderInformasiPermohonan' => $dataProviderInformasiPermohonan,
        'readonly' => $readonly,
    ]) ?>

</div>
