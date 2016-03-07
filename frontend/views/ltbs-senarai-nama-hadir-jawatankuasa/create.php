<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LtbsSenaraiNamaHadirJawatankuasa */

$this->title = 'Tambah Kehadiran Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Kehadiran Mesyuarat Jawatankuasa Menetapkan Mesyuarat Agong', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ltbs-senarai-nama-hadir-jawatankuasa-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
