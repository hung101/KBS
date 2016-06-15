<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanInsentifTetapan */

$this->title = GeneralLabel::pengurusan_insentif_tetapan;
//$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_insentif_tetapan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-insentif-tetapan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanInsentifTetapanShakamShakar' => $searchModelPengurusanInsentifTetapanShakamShakar,
        'dataProviderPengurusanInsentifTetapanShakamShakar' => $dataProviderPengurusanInsentifTetapanShakamShakar,
        'readonly' => $readonly,
    ]) ?>

</div>
