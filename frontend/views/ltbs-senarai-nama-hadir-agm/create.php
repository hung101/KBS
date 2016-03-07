<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LtbsSenaraiNamaHadirAgm */

$this->title = 'Tambah Nama Kehadiran Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Nama Kehadiran Mesyuarat Agong', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-senarai-nama-hadir-agm-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
