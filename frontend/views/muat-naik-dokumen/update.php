<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\MuatNaikDokumen */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::muat_naik_dokumen.': ' . ' ' . $model->muat_naik_dokumen_id;
$this->title = GeneralLabel::updateTitle . ' Muat Naik Dokumen';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::muat_naik_dokumen, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Muat Naik Dokumen', 'url' => ['view', 'id' => $model->muat_naik_dokumen_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="muat-naik-dokumen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
