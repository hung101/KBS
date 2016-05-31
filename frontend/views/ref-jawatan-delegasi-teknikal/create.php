<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanDelegasiTeknikal */

$this->title = 'Create Ref Jawatan Delegasi Teknikal';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Delegasi Teknikals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-delegasi-teknikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
