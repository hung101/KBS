<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPersatuan */

$this->title = 'Create Ref Persatuan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Persatuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-persatuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
