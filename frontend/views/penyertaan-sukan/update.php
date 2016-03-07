<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukan */

//$this->title = 'Update Penyertaan Sukan: ' . ' ' . $model->penyertaan_sukan_id;
$this->title = GeneralLabel::updateTitle . ' Penilaian Prestasi Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Penilaian Prestasi Kejohanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penilaian Prestasi Kejohanan', 'url' => ['view', 'id' => $model->penyertaan_sukan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
        'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
        'readonly' => $readonly,
    ]) ?>

</div>
