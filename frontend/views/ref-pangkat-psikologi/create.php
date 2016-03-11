<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPangkatPsikologi */

$this->title = 'Create Ref Pangkat Psikologi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Pangkat Psikologis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-pangkat-psikologi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
