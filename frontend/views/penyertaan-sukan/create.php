<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::penilaian_prestasi_kejohanan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_prestasi_kejohanan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenyertaanSukanAcara' => $searchModelPenyertaanSukanAcara,
        'dataProviderPenyertaanSukanAcara' => $dataProviderPenyertaanSukanAcara,
        'readonly' => $readonly,
    ]) ?>

</div>
