<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BorangAduanKerosakan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::borang_aduan_kerosakan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::borang_aduan_kerosakan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="borang-aduan-kerosakan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelBorangAduanKerosakanJenisKerosakan' => $searchModelBorangAduanKerosakanJenisKerosakan,
        'dataProviderBorangAduanKerosakanJenisKerosakan' => $dataProviderBorangAduanKerosakanJenisKerosakan,
        'readonly' => $readonly,
    ]) ?>

</div>
