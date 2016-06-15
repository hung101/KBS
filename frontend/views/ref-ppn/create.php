<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPpn */

$this->title = 'Create Ref Ppn';
$this->params['breadcrumbs'][] = ['label' => 'Ref Ppns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-ppn-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
