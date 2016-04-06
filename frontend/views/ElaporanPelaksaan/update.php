<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ElaporanPelaksaan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::elaporan_pelaksaan.': ' . ' ' . $model->elaporan_pelaksaan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_pelaksaans, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->elaporan_pelaksaan_id, 'url' => ['view', 'id' => $model->elaporan_pelaksaan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="elaporan-pelaksaan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
