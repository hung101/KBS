<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBandar */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::bandar;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::alamat_badan_sukan_bandar, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bandar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
