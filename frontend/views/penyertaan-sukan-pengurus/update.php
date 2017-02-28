<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPengurus */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::penyertaan_sukan_pengurus.': ' . ' ' . $model->penyertaan_sukan_pengurus_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyertaan_sukan_pengurus, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->penyertaan_sukan_pengurus_id, 'url' => ['view', 'id' => $model->penyertaan_sukan_pengurus_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penyertaan-sukan-pengurus-update">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
