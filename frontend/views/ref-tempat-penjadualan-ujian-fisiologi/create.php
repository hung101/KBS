<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTempatPenjadualanUjianFisiologi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tempat_penjadualan_ujian_fisiologi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tempat_penjadualan_ujian_fisiologi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tempat-penjadualan-ujian-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
