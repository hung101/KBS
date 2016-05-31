<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanJawatankuasaKhas */

$this->title = 'Create Ref Jawatan Jawatankuasa Khas';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Jawatankuasa Khas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-jawatankuasa-khas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
