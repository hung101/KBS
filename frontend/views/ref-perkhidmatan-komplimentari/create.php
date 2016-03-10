<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerkhidmatanKomplimentari */

$this->title = 'Create Ref Perkhidmatan Komplimentari';
$this->params['breadcrumbs'][] = ['label' => 'Ref Perkhidmatan Komplimentaris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perkhidmatan-komplimentari-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
