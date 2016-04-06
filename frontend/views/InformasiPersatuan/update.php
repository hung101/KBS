<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InformasiPersatuan */

$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::informasi_persatuan.': ' . ' ' . $model->informasi_persatuan_id;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::informasi_persatuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->informasi_persatuan_id, 'url' => ['view', 'id' => $model->informasi_persatuan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="informasi-persatuan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
