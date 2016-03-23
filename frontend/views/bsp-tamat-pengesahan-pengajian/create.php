<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspTamatPengesahanPengajian */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pengesahan_tamat_pengajian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengesahan_tamat_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-tamat-pengesahan-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
