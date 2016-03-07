<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanCadanganKertasKerja */

$this->title = 'Update Permohonan Ebantuan Cadangan Kertas Kerja: ' . ' ' . $model->permohonan_e_bantuan_cadangan_kertas_kerja_id;
$this->params['breadcrumbs'][] = ['label' => 'Permohonan Ebantuan Cadangan Kertas Kerjas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->permohonan_e_bantuan_cadangan_kertas_kerja_id, 'url' => ['view', 'id' => $model->permohonan_e_bantuan_cadangan_kertas_kerja_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permohonan-ebantuan-cadangan-kertas-kerja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
