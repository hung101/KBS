<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MuatNaikDokumen */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::maklumat_sukan_malaysia.': ' . ' ' . $model->muat_naik_dokumen_id;
$this->title = GeneralLabel::updateTitle . ' ' . GeneralLabel::maklumat_sukan_malaysia;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_sukan_malaysia, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' ' . GeneralLabel::maklumat_sukan_malaysia, 'url' => ['view', 'id' => $model->muat_naik_dokumen_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muat-naik-dokumen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
