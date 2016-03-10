<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefStatusAduanPenyertaanSukan */

$this->title = 'Update Ref Status Aduan Penyertaan Sukan: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Aduan Penyertaan Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-status-aduan-penyertaan-sukan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
