<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanSebab */

//$this->title = 'Update Bsp Perlanjutan Sebab: ' . ' ' . $model->bsp_perlanjutan_sebab_id;
$this->title = GeneralLabel::updateTitle . ' Sebab Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => 'Sebab Pelanjutan', 'url' => ['index']];
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
