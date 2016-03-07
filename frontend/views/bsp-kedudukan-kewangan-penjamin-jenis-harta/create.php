<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjaminJenisHarta */

$this->title = GeneralLabel::createTitle . ' Kedudukan Kewangan Penjamin (Jenis Harta)';
$this->params['breadcrumbs'][] = ['label' => 'Kedudukan Kewangan Penjamin (Jenis Harta)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-jenis-harta-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
