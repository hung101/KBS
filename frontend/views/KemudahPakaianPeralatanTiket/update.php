<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KemudahPakaianPeralatanTiket */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::kemudah_pakaian_peralatan_tiket.': ' . ' ' . $model->kemudah_pakaian_peralatan_tiket_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kemudah_pakaian_peralatan_tikets, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->kemudah_pakaian_peralatan_tiket_id, 'url' => ['view', 'id' => $model->kemudah_pakaian_peralatan_tiket_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kemudah-pakaian-peralatan-tiket-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
