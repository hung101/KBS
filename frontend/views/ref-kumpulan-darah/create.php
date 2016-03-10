<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKumpulanDarah */

$this->title = 'Create Ref Kumpulan Darah';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kumpulan Darahs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kumpulan-darah-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
