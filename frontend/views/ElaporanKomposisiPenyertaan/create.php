<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKomposisiPenyertaan */

$this->title = 'Tambah e-Laporan Komposisi Penyertaan';
$this->params['breadcrumbs'][] = ['label' => 'e-Laporan Komposisi Penyertaan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-komposisi-penyertaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
