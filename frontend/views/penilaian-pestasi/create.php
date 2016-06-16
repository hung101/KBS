<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PenilaianPestasi */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::penilaian_pestasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penilaian_pestasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-pestasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelPenilaianPrestasiAtletSasaran' => $searchModelPenilaianPrestasiAtletSasaran,
        'dataProviderPenilaianPrestasiAtletSasaran' => $dataProviderPenilaianPrestasiAtletSasaran,
        'readonly' => $readonly,
    ]) ?>

</div>
