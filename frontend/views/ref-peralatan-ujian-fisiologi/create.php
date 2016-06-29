<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeralatanUjianFisiologi */

$this->title = 'Create Ref Peralatan Ujian Fisiologi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peralatan Ujian Fisiologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peralatan-ujian-fisiologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
