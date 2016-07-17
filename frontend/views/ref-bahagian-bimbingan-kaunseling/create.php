<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBahagianBimbinganKaunseling */

$this->title = 'Create Ref Bahagian Bimbingan Kaunseling';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bahagian Bimbingan Kaunselings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bahagian-bimbingan-kaunseling-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
