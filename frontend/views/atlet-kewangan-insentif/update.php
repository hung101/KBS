<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganInsentif */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_kewangan_insentif.': ' . ' ' . $model->insentif_id;
$this->title = GeneralLabel::updateTitle . ' '. GeneralLabel::insentif;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::insentif, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '. GeneralLabel::insentif, 'url' => ['view', 'id' => $model->insentif_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-insentif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
