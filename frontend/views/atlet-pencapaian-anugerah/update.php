<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianAnugerah */

//$this->title = 'Update Atlet Pencapaian Anugerah: ' . ' ' . $model->anugerah_id;
$this->title = GeneralLabel::updateTitle . ' Anugerah';
$this->params['breadcrumbs'][] = ['label' => 'Anugerah', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Anugerah', 'url' => ['view', 'id' => $model->anugerah_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-anugerah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
