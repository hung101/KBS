<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanInduk */

$this->title = 'Create Ref Jawatan Induk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Induks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-induk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
