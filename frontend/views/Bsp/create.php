<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bsp */

$this->title = GeneralLabel::pemohonan_biasiswa_sukan_persekutuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pemohonan_biasiswa_sukan_persekutuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
