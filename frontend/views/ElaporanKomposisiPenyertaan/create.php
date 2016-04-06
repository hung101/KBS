<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaporanKomposisiPenyertaan */

$this->title = GeneralLabel::tambah_elaporan_komposisi_penyertaan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::elaporan_komposisi_penyertaan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaporan-komposisi-penyertaan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
