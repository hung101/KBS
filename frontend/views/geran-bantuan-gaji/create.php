<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\GeranBantuanGaji */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::geran_bantuan_gaji;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::geran_bantuan_gaji, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geran-bantuan-gaji-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'searchModelGeranBantuanGajiLampiran' => $searchModelGeranBantuanGajiLampiran,
		'dataProviderGeranBantuanGajiLampiran' => $dataProviderGeranBantuanGajiLampiran,
        'readonly' => $readonly,
    ]) ?>

</div>
