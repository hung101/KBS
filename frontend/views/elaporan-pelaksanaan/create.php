<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaan */

$this->title = GeneralLabel::createTitle . ' E-Laporan Pelaksanaan / Program / Aktiviti';
$this->params['breadcrumbs'][] = ['label' => 'E-Laporan Pelaksanaan / Program / Aktiviti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-pelaksanaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelGambar' => $searchModelGambar,
        'dataProviderGambar' => $dataProviderGambar,
        'searchModelObjektif' => $searchModelObjektif,
        'dataProviderObjektif' => $dataProviderObjektif,
        'searchModelKerjasama' => $searchModelKerjasama,
        'dataProviderKerjasama' => $dataProviderKerjasama,
        'searchModelKekurangan' => $searchModelKekurangan,
        'dataProviderKekurangan' => $dataProviderKekurangan,
        'searchModelKelebihan' => $searchModelKelebihan,
        'dataProviderKelebihan' => $dataProviderKelebihan,
        'readonly' => $readonly,
    ]) ?>

</div>
