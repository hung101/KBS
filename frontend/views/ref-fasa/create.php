<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefFasa */

$this->title = 'Create Ref Fasa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Fasas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-fasa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
