<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPenyakit */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::penyakit;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyakit_semula_jadi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-penyakit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
