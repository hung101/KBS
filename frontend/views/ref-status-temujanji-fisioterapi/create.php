<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusTemujanjiFisioterapi */

$this->title = 'Create Ref Status Temujanji Fisioterapi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Temujanji Fisioterapis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-temujanji-fisioterapi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
