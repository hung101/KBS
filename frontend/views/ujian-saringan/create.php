<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\UjianSaringan */

$this->title = GeneralLabel::createTitle . ' Maklumat Bakat';
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_bakat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ujian-saringan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
