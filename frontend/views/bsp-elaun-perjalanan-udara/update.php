<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspElaunPerjalananUdara */

//$this->title = 'Update Bsp Elaun Perjalanan Udara: ' . ' ' . $model->bsp_elaun_perjalanan_udara_id;
$this->title = GeneralLabel::updateTitle . ' Elaun Perjalanan Udara';
$this->params['breadcrumbs'][] = ['label' => 'Elaun Perjalanan Udara', 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Elaun Perjalanan Udara', 'url' => ['view', 'id' => $model->bsp_elaun_perjalanan_udara_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-perjalanan-udara-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
