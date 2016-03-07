<?php

use yii\helpers\Html;

// contant values
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanElaun */

//$this->title = 'Update Bantuan Elaun: ' . ' ' . $model->bantuan_elaun_id;
$this->title = GeneralLabel::updateTitle . ' Bantuan Elaun SUE/Elaun Penyelaras/Emolumen PSK';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Elaun SUE/Elaun Penyelaras/Emolumen PSK', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::viewTitle . ' Bantuan Elaun SUE/Elaun Penyelaras/Emolumen PSK', 'url' => ['view', 'id' => $model->bantuan_elaun_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-elaun-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
