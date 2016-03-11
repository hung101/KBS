<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaAhliJkkJkp */

$this->title = 'Create Ref Nama Ahli Jkk Jkp';
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Ahli Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-ahli-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
