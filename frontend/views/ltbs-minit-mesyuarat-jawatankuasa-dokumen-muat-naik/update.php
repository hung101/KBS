<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsMinitMesyuaratJawatankuasaDokumenMuatNaik */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naik.': ' . ' ' . $model->dokumen_muat_naik_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ltbs_minit_mesyuarat_jawatankuasa_dokumen_muat_naiks, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->dokumen_muat_naik_id, 'url' => ['view', 'id' => $model->dokumen_muat_naik_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ltbs-minit-mesyuarat-jawatankuasa-dokumen-muat-naik-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
