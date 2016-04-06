<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaklumatKongresDiLuarNegara */

$this->title = GeneralLabel::tambah_maklumat_kongres_di_luar_negara;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::maklumat_kongres_di_luar_negara, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-kongres-di-luar-negara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
