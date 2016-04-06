<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratSenaraiNamaHadir */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::mesyuarat_senarai_nama_hadir.': ' . ' ' . $model->senarai_nama_hadir_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat_senarai_nama_hadirs, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_nama_hadir_id, 'url' => ['view', 'id' => $model->senarai_nama_hadir_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mesyuarat-senarai-nama-hadir-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
