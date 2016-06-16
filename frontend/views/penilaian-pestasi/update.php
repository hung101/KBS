<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPestasi */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::penilaian_pestasi.': ' . ' ' . $model->penilaian_pestasi_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::penilaian_pestasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_pestasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::penilaian_pestasi, 'url' => ['view', 'id' => $model->penilaian_pestasi_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-pestasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
        'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
        'readonly' => $readonly,
    ]) ?>

</div>
