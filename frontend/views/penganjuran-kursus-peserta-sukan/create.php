<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenganjuranKursusPesertaSukan */

$this->title = 'Create Penganjuran Kursus Peserta Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Penganjuran Kursus Peserta Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penganjuran-kursus-peserta-sukan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
