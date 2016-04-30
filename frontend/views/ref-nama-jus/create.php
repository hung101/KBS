<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaJus */

$this->title = 'Create Ref Nama Jus';
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Juses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-jus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
