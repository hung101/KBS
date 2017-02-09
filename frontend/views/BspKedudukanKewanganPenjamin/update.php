<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjamin */

$this->title = 'Update Bsp Kedudukan Kewangan Penjamin: ' . ' ' . $model->bsp_kedudukan_kewangan_penjamin_id;
$this->params['breadcrumbs'][] = ['label' => 'Bsp Kedudukan Kewangan Penjamins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bsp_kedudukan_kewangan_penjamin_id, 'url' => ['view', 'id' => $model->bsp_kedudukan_kewangan_penjamin_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bsp-kedudukan-kewangan-penjamin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
