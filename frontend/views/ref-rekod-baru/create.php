<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRekodBaru */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::rekod_baru;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::rekod_baru, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rekod-baru-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
