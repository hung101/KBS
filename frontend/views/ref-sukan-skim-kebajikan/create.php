<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSukanSkimKebajikan */

$this->title = 'Create Ref Sukan Skim Kebajikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sukan Skim Kebajikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-skim-kebajikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
