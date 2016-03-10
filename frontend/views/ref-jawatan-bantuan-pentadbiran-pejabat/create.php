<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJawatanBantuanPentadbiranPejabat */

$this->title = 'Create Ref Jawatan Bantuan Pentadbiran Pejabat';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jawatan Bantuan Pentadbiran Pejabats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-bantuan-pentadbiran-pejabat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
