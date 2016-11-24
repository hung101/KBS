<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefMatawang */

$this->title = 'Create Ref Matawang';
$this->params['breadcrumbs'][] = ['label' => 'Ref Matawangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-matawang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
