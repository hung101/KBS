<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSukanRekreasi */

$this->title = 'Create Ref Sukan Rekreasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Sukan Rekreasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-sukan-rekreasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
