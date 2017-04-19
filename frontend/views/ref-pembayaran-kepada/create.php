<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefPembayaranKepada */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::pembayaran_kepada;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pembayaran_kepada, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pembayaran-kepada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
