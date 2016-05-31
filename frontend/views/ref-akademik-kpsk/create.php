<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAkademikKpsk */

$this->title = 'Create Ref Akademik Kpsk';
$this->params['breadcrumbs'][] = ['label' => 'Ref Akademik Kpsks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-akademik-kpsk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
