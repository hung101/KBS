<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanSainsSukan */

$this->title = 'Create Ref Kelulusan Sains Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Sains Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-sains-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
