<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiKaunseling */

$this->title = 'Create Ref Agensi Kaunseling';
$this->params['breadcrumbs'][] = ['label' => 'Ref Agensi Kaunselings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-kaunseling-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
