<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKemahiran */

$this->title = GeneralLabel::createTitle.' '.'Ref Jenis Kemahiran';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kemahirans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kemahiran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
