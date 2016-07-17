<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiOku */

$this->title = 'Create Ref Agensi Oku';
$this->params['breadcrumbs'][] = ['label' => 'Ref Agensi Okus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-oku-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
