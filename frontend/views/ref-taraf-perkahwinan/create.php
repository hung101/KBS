<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTarafPerkahwinan */

$this->title = 'Create Ref Taraf Perkahwinan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Taraf Perkahwinans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-taraf-perkahwinan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
