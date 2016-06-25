<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanJawatankuasaPemilihan */

$this->title = 'Create Ref Jawatan Jawatankuasa Pemilihan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Jawatankuasa Pemilihans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-jawatankuasa-pemilihan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
