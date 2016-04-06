<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanCadanganKertasKerja */

$this->title = GeneralLabel::tambah_permohonan_ebantuan_cadangan_kertas_kerja;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_ebantuan_cadangan_kertas_kerja, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-cadangan-kertas-kerja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
