<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanCadanganKertasKerja */

$this->title = 'Tambah Permohonan e-Bantuan Cadangan Kertas Kerja';
$this->params['breadcrumbs'][] = ['label' => 'Permohonan e-Bantuan Cadangan Kertas Kerja', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-cadangan-kertas-kerja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
