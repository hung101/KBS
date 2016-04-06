<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenyelidikanKomposisiPasukan */

$this->title = GeneralLabel::tambah_penyelidikan_komposisi_pasukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::penyelidikan_komposisi_pasukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penyelidikan-komposisi-pasukan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
