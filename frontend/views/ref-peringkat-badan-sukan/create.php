<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBadanSukan */

$this->title = 'Create Ref Peringkat Badan Sukan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Badan Sukans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-badan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
