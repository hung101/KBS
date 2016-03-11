<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefBangsa */

$this->title = 'Create Ref Bangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Bangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-bangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
