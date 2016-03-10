<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSukanAkademi */

$this->title = 'Create Ref Sukan Akademi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sukan Akademis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-akademi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
