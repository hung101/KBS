<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanProgramBinaanJurulatih */

$this->title = $model->penyertaan_sukan_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Penyertaan Sukan Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-jurulatih-view">
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
