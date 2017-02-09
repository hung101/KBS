<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjaminJenisHarta */

$this->title = 'Update Bsp Kedudukan Kewangan Penjamin Jenis Harta: ' . ' ' . $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Kedudukan Kewangan Penjamin Jenis Hartas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id, 'url' => ['view', 'id' => $model->bsp_kedudukan_kewangan_penjamin_jenis_harta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
