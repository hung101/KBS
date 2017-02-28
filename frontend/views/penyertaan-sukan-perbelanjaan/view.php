<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPerbelanjaan */

$this->title = $model->penyertaan_sukan_perbelanjaan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::perbelanjaan_penyertaan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-perbelanjaan-view">
    
    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
