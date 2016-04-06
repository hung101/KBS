<?php

use yii\helpers\Html;
use yii\helpers\Url;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPenjamin */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_penjamin.': ' . ' ' . $model->bsp_penjamin_id;
$this->title = GeneralLabel::updateTitle . ' Penjamin Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penjamin_biasiswa_sukan_persekutuan, 'url' => Url::to(['index', 'bsp_pemohon_id' => $model->bsp_pemohon_id])];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Penjamin Biasiswa Sukan Persekutuan', 'url' => ['view', 'id' => $model->bsp_penjamin_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-penjamin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
