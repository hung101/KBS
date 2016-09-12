<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefSumberKewanganBantuanPenganjuranKejohanan */

$this->title = 'Update Ref Sumber Kewangan Bantuan Penganjuran Kejohanan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Sumber Kewangan Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-sumber-kewangan-bantuan-penganjuran-kejohanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
