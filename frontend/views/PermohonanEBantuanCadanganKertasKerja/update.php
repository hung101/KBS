<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanCadanganKertasKerja */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::permohonan_ebantuan_cadangan_kertas_kerja.': ' . ' ' . $model->permohonan_e_bantuan_cadangan_kertas_kerja_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_cadangan_kertas_kerjas, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_e_bantuan_cadangan_kertas_kerja_id, 'url' => ['view', 'id' => $model->permohonan_e_bantuan_cadangan_kertas_kerja_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-cadangan-kertas-kerja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
