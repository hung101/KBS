<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusPerlesenanAkk */

$this->title = 'Create Ref Status Perlesenan Akk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Perlesenan Akks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-perlesenan-akk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
