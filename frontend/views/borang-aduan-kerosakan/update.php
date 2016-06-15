<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKerosakan */

//$this->title = 'Update Borang Aduan Kerosakan: ' . $model->borang_aduan_kerosakan_id;

$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::borang_aduan_kerosakan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_aduan_kerosakan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::borang_aduan_kerosakan, 'url' => ['view', 'id' => $model->borang_aduan_kerosakan_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kerosakan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBorangAduanKerosakanJenisKerosakan' => $searchModelBorangAduanKerosakanJenisKerosakan,
        'dataProviderBorangAduanKerosakanJenisKerosakan' => $dataProviderBorangAduanKerosakanJenisKerosakan,
        'readonly' => $readonly,
    ]) ?>

</div>
