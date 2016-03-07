<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspTuntutanElaunTesis */

//$this->title = 'Update Bsp Tuntutan Elaun Tesis: ' . ' ' . $model->bsp_tuntutan_elaun_tesis_od;
$this->title = GeneralLabel::updateTitle . ' Tuntutan Elaun Tesis';
$this->params['breadcrumbs'][] = ['label' => 'Tuntutan Elaun Tesis', 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Tuntutan Elaun Tesis', 'url' => ['view', 'id' => $model->bsp_tuntutan_elaun_tesis_od]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tuntutan-elaun-tesis-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
