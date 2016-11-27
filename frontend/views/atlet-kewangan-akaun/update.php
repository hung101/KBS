<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganAkaun */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_kewangan_akaun.': ' . ' ' . $model->akaun_id;
$this->title = GeneralLabel::updateTitle . ' ' .GeneralLabel::akaun;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::akaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' '.GeneralLabel::akaun, 'url' => ['view', 'id' => $model->akaun_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-akaun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
