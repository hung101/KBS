<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPenganjurKursusSoalan */

$this->title = 'Update Penilaian Penganjur Kursus Soalan: ' . $model->penilaian_peserta_terhadap_kursus_soalan_id;
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Penganjur Kursus Soalans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penilaian_peserta_terhadap_kursus_soalan_id, 'url' => ['view', 'id' => $model->penilaian_peserta_terhadap_kursus_soalan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penilaian-peserta-terhadap-kursus-soalan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
