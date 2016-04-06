<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKebajikan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_kebajikan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_kebajikan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kebajikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
