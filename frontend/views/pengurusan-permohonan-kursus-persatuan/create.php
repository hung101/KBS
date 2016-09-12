<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPermohonanKursusPersatuan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::permohonan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::permohonan_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-permohonan-kursus-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanPermohonanKursusPersatuanPenasihat' => $searchModelPengurusanPermohonanKursusPersatuanPenasihat,
        'dataProviderPengurusanPermohonanKursusPersatuanPenasihat' => $dataProviderPengurusanPermohonanKursusPersatuanPenasihat,
        'readonly' => $readonly,
    ]) ?>

</div>
