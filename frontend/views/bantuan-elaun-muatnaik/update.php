<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\InformasiPermohonan */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::informasi_permohonan.': ' . ' ' . $model->bantuan_elaun_muatnaik_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::lampiran_perbelanjaanresit;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lampiran_perbelanjaanresit, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::lampiran_perbelanjaanresit, 'url' => ['view', 'id' => $model->bantuan_elaun_muatnaik_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-elaun-muatnaik-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
