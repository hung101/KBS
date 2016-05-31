<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJawatankuasaKhasSukanMalaysiaAhli */

$this->title = 'Create Pengurusan Jawatankuasa Khas Sukan Malaysia Ahli';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Jawatankuasa Khas Sukan Malaysia Ahlis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jawatankuasa-khas-sukan-malaysia-ahli-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
