<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPingatInsentif */

$this->title = 'Create Ref Pingat Insentif';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pingat Insentifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pingat-insentif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
