<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSekolah */

$this->title = GeneralLabel::createTitle.' '.'Ref Sekolah';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sekolahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sekolah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
