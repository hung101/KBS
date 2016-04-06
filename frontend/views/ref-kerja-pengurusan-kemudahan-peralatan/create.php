<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKerjaPengurusanKemudahanPeralatan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kerja_pengurusan_kemudahan_peralatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kerja_pengurusan_kemudahan_peralatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kerja-pengurusan-kemudahan-peralatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
