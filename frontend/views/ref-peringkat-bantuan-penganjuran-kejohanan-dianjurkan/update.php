<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBantuanPenganjuranKejohananDianjurkan */

$this->title = 'Update Ref Peringkat Bantuan Penganjuran Kejohanan Dianjurkan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Bantuan Penganjuran Kejohanan Dianjurkans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-peringkat-bantuan-penganjuran-kejohanan-dianjurkan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
