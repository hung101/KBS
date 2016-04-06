<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSaizPakaian */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::saiz_pakaian;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::saiz_pakaian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-saiz-pakaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
