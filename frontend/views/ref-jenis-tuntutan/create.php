<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisTuntutan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_tuntutan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_tuntutan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-tuntutan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
