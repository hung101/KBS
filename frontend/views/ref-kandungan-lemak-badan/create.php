<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefKandunganLemakBadan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kandungan_lemak_badan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kandungan_lemak_badan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kandungan-lemak-badan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
