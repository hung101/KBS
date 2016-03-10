<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanFisiologi */

$this->title = 'Create Ref Perkhidmatan Fisiologi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Perkhidmatan Fisiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
