<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPerwakilan */

$this->title = 'Create Ref Perwakilan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Perwakilans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-perwakilan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
