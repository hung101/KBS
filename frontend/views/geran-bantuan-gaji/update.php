<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\GeranBantuanGaji */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::geran_bantuan_gaji.': ' . ' ' . $model->geran_bantuan_gaji_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::geran_bantuan_gaji;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::geran_bantuan_gaji, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::geran_bantuan_gaji, 'url' => ['view', 'id' => $model->geran_bantuan_gaji_id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="geran-bantuan-gaji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'searchModelGeranBantuanGajiLampiran' => $searchModelGeranBantuanGajiLampiran,
		'dataProviderGeranBantuanGajiLampiran' => $dataProviderGeranBantuanGajiLampiran,
        'readonly' => $readonly,
    ]) ?>

</div>
