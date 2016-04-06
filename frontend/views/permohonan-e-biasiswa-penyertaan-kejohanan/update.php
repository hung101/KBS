<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswaPenyertaanKejohanan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebiasiswa_penyertaan_kejohanan.': ' . ' ' . $model->penyertaan_kejohanan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebiasiswa_penyertaan_kejohanans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penyertaan_kejohanan_id, 'url' => ['view', 'id' => $model->penyertaan_kejohanan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebiasiswa-penyertaan-kejohanan-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
