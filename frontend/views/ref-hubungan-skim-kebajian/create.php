<?php

use yii\helpers\Html;
use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\RefHubunganSkimKebajian */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::hubungan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::hubungan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-hubungan-skim-kebajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
