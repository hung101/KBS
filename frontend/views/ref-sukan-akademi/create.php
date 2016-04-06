<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSukanAkademi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sukan_akademi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sukan_akademi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-akademi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
