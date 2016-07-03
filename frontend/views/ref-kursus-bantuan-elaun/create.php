<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKursusBantuanElaun */

$this->title = 'Create Ref Kursus Bantuan Elaun';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kursus Bantuan Elauns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kursus-bantuan-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
