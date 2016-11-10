<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiMedia */

$this->title = 'Create Agensi Media';
$this->params['breadcrumbs'][] = ['label' => 'Agensi Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-media-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
