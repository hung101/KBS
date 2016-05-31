<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanJawatankuasaKhas */

$this->title = 'Update Ref Jawatan Jawatankuasa Khas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Jawatankuasa Khas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-jawatan-jawatankuasa-khas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
