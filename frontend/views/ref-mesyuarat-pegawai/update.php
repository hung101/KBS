<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefMesyuaratPegawai */

$this->title = 'Update Ref Mesyuarat Pegawai: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Mesyuarat Pegawais', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-mesyuarat-pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
