<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisInsentif */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Insentif';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Insentifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
