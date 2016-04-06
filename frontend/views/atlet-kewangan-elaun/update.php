<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AtletKewanganElaun */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::atlet_kewangan_elaun.': ' . ' ' . $model->elaun_id;
$this->title = GeneralLabel::updateTitle . ' Elaun';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaun, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Elaun', 'url' => ['view', 'id' => $model->elaun_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-kewangan-elaun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
