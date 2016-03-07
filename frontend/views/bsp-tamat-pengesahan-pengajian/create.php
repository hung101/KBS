<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspTamatPengesahanPengajian */

$this->title = GeneralLabel::createTitle . ' Pengesahan Tamat Pengajian';
$this->params['breadcrumbs'][] = ['label' => 'Pengesahan Tamat Pengajian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tamat-pengesahan-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
