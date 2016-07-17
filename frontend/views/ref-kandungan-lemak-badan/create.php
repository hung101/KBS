<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKandunganLemakBadan */

$this->title = 'Create Ref Kandungan Lemak Badan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kandungan Lemak Badans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kandungan-lemak-badan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
