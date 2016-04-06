<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsNotisAgm */

//$this->title = GeneralLabel::tambah_notis_mesyuarat_agong;
$this->title = GeneralLabel::notis_mesyuarat_agong;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::notis_mesyuarat_agong, 'url' => ['index']];
$this->params['breadcrumbs'][] = GeneralLabel::createTitle;
?>
<div class="ltbs-notis-agm-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
