<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PemohonKursusTahapAkk */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::pemohon_kursus_tahap_akk.': ' . ' ' . $model->pemohon_kursus_tahap_akk_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemohon_kursus_tahap_akks, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pemohon_kursus_tahap_akk_id, 'url' => ['view', 'id' => $model->pemohon_kursus_tahap_akk_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pemohon-kursus-tahap-akk-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
