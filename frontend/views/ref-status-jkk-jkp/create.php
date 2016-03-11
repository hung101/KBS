<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusJkkJkp */

$this->title = 'Create Ref Status Jkk Jkp';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
