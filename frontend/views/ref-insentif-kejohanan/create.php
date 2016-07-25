<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefInsentifKejohanan */

$this->title = 'Create Ref Insentif Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Insentif Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-insentif-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
