<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenyertaanSukanPengurus */

$this->title = GeneralLabel::tambah.' '.GeneralLabel::pengurus_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pengurus_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyertaan-sukan-pengurus-create">

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
