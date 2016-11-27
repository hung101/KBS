<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletPakaian */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_pakaian.': ' . ' ' . $model->pakaian_id;
$this->title = GeneralLabel::updateTitle . ' '.GeneralLabel::atlet_pakaians;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pakaian_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::atlet_pakaians, 'url' => ['view', 'id' => $model->pakaian_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-pakaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
