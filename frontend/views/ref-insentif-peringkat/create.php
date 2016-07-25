<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefInsentifPeringkat */

$this->title = 'Create Ref Insentif Peringkat';
$this->params['breadcrumbs'][] = ['label' => 'Ref Insentif Peringkats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-insentif-peringkat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
