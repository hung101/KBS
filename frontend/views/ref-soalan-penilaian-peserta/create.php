<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPenilaianPeserta */

$this->title = GeneralLabel::createTitle.' '.'Ref Soalan Penilaian Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Ref Soalan Penilaian Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-soalan-penilaian-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
