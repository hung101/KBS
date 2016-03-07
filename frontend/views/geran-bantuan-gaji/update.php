<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\GeranBantuanGaji */

//$this->title = 'Update Geran Bantuan Gaji: ' . ' ' . $model->geran_bantuan_gaji_id;
$this->title = GeneralLabel::updateTitle . ' Geran Bantuan Gaji';
$this->params['breadcrumbs'][] = ['label' => 'Geran Bantuan Gaji', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Geran Bantuan Gaji', 'url' => ['view', 'id' => $model->geran_bantuan_gaji_id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="geran-bantuan-gaji-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
