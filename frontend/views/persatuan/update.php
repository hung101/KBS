<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_bendahari_ipt.': ' . ' ' . $model->bsp_bendahari_ipt_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::persatuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::persatuan, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-e-bantuan-urusetia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'searchModelBE' => $searchModelBE,
        'dataProviderBE' => $dataProviderBE,
        'searchModelPPB' => $searchModelPPB,
        'dataProviderPPB' => $dataProviderPPB,
    ]) ?>

</div>
