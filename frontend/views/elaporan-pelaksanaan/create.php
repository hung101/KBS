<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksanaan */

$this->title = GeneralLabel::elaporan_pelaksanaan_program_aktiviti;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_pelaksanaan_program_aktiviti, 'url' => ['index']];
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
