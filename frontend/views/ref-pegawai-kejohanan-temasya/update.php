<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPegawaiKejohananTemasya */

$this->title = 'Update Ref Pegawai Kejohanan Temasya: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Pegawai Kejohanan Temasyas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-pegawai-kejohanan-temasya-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
