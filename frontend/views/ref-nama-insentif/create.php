<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaInsentif */

$this->title = 'Create Ref Nama Insentif';
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Insentifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
