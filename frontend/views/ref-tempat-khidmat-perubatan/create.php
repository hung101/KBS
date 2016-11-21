<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTempatKhidmatPerubatan */

$this->title = 'Create Ref Tempat Khidmat Perubatan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tempat Khidmat Perubatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tempat-khidmat-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
