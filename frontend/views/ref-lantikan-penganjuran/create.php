<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefLantikanPenganjuran */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::lantikan_penganjuran;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::lantikan_penganjuran, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-lantikan-penganjuran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
