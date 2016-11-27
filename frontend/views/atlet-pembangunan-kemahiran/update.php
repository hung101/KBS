<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPembangunanKemahiran */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_pembangunan_kemahiran.': ' . ' ' . $model->kemahiran_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::kemahiran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kemahiran, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::kemahiran, 'url' => ['view', 'id' => $model->kemahiran_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pembangunan-kemahiran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
