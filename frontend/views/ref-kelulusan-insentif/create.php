<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanInsentif */

$this->title = 'Create Ref Kelulusan Insentif';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Insentifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
