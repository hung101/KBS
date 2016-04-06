<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LtbsSenaraiNamaHadirAgm */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::ltbs_senarai_nama_hadir_agm.': ' . ' ' . $model->senarai_nama_hadir_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::ltbs_senarai_nama_hadir_agms, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_nama_hadir_id, 'url' => ['view', 'id' => $model->senarai_nama_hadir_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ltbs-senarai-nama-hadir-agm-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
