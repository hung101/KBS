<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanSukanSpesifik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kelulusan_sukan_spesifik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kelulusan_sukan_spesifik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-sukan-spesifik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
