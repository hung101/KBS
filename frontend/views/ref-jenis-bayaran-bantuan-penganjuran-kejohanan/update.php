<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisBayaranBantuanPenganjuranKejohanan */

$this->title = 'Update Ref Jenis Bayaran Bantuan Penganjuran Kejohanan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Bayaran Bantuan Penganjuran Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jenis-bayaran-bantuan-penganjuran-kejohanan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
