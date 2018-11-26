<?php

namespace backend\widgets;

use Yii;
use yii\grid\GridView as YiiGridView;

class GridView extends YiiGridView {

    public function init() {
        parent::init();
        $this->options = ['class' => 'grid-view', 'id' => 'grid'];
        $this->layout = '{items}<div class="row"><div class="col-xs-6">{pager}</div><div class="col-xs-6"><div class="pull-right">{summary}</div></div></div>';
        $this->emptyText = Yii::t('app', 'No data');
        $this->summary = '{begin} - {end} ' . Yii::t('app', 'Records') . ' {totalCount} ' . Yii::t('app', 'Pages') . ' {pageCount}';
        $this->pager = ['firstPageLabel' => Yii::t('app', 'Home'), 'prevPageLabel' => Yii::t('app', 'Prev'), 'nextPageLabel' => Yii::t('app', 'Next'), 'lastPageLabel' => Yii::t('app', 'Last')];
        $this->tableOptions = ['class' => 'table table-striped table-bordered table-hover'];
    }

}
