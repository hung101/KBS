<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ProfilDelegasiTeknikalAhli */

$this->title = 'Create Profil Delegasi Teknikal Ahli';
$this->params['breadcrumbs'][] = ['label' => 'Profil Delegasi Teknikal Ahlis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profil-delegasi-teknikal-ahli-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
