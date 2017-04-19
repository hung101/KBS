<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefJenisLesenParalimpik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::jenis_lesen_paralimpik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::jenis_lesen_paralimpik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-lesen-paralimpik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
