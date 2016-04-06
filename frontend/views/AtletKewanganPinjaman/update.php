<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganPinjaman */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_kewangan_pinjaman.': ' . ' ' . $model->pinjaman_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::atlet_kewangan_pinjamen, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pinjaman_id, 'url' => ['view', 'id' => $model->pinjaman_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="atlet-kewangan-pinjaman-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
