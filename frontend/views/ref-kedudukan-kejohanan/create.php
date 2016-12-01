<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKedudukanKejohanan */

$this->title = 'Create Ref Kedudukan Kejohanan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kedudukan Kejohanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kedudukan-kejohanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
