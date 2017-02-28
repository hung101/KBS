<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPegawai */

$this->title = $model->penyertaan_sukan_pegawai_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyertaan_sukan_pegawai, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-pegawai-view">
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
