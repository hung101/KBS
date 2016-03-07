<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\BantuanElaun */

$this->title = GeneralLabel::createTitle . ' Bantuan Elaun SUE/Elaun Penyelaras/Emolumen PSK';
$this->params['breadcrumbs'][] = ['label' => 'Bantuan Elaun SUE/Elaun Penyelaras/Emolumen PSK', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bantuan-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
