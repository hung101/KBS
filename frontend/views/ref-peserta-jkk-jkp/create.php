<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPesertaJkkJkp */

$this->title = 'Create Ref Peserta Jkk Jkp';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peserta Jkk Jkps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peserta-jkk-jkp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
