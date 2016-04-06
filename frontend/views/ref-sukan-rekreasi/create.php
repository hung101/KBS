<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSukanRekreasi */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::sukan_rekreasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sukan_rekreasis, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-rekreasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
