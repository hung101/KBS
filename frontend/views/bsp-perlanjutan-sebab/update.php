<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanSebab */

//$this->title = GeneralLabel::updateTitle.' '.GeneralLabel::bsp_perlanjutan_sebab.': ' . ' ' . $model->bsp_perlanjutan_sebab_id;
$this->title = GeneralLabel::updateTitle . ' Sebab Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sebab_pelanjutan, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Sebab Pelanjutan', 'url' => ['view', 'id' => $model->bsp_perlanjutan_sebab_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-sebab-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
