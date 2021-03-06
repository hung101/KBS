<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPencapaianAnugerah */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_pencapaian_anugerah.': ' . ' ' . $model->anugerah_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::anugerah;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::anugerah, 'url' => ['view', 'id' => $model->anugerah_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pencapaian-anugerah-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
