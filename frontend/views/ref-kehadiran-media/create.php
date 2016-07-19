<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKehadiranMedia */

$this->title = 'Create Ref Kehadiran Media';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kehadiran Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kehadiran-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
