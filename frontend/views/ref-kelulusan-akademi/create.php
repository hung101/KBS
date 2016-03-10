<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanAkademi */

$this->title = 'Create Ref Kelulusan Akademi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Akademis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-akademi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
