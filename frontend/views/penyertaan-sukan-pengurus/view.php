<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPegawai */

$this->title = $model->penyertaan_sukan_pengurus_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyertaan_sukan_pengurus, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-pengurus-view">
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
