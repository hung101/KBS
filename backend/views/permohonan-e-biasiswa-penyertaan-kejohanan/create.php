<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBiasiswaPenyertaanKejohanan */

$this->title = 'Tambah Penyertaan Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Penyertaan Kejohanan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebiasiswa-penyertaan-kejohanan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
