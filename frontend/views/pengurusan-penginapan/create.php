<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanPenginapan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengurusan_penginapan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurusan_penginapan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-penginapan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPengurusanPenginapanAtlet' => $searchModelPengurusanPenginapanAtlet,
        'dataProviderPengurusanPenginapanAtlet' => $dataProviderPengurusanPenginapanAtlet,
        'readonly' => $readonly,
    ]) ?>

</div>
