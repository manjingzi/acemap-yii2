<?php

namespace backend\modules\rbac\search;

use yii\data\ActiveDataProvider;
use common\models\AuthItem;

class AuthItemSearch extends AuthItem {

    public $pagesize = 10;
    public $type;
    public $keyword;
    public $start_time;
    public $end_time;
    private $time_field = 'created_at';

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize'], 'integer'],
            [['start_time', 'end_time'], 'date']
        ];
    }

    public function search($params) {
        $query = AuthItem::find()->where(['type' => $this->type]);

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'name', $this->keyword],
                    ['like', 'rule_name', $this->keyword],
                    ['like', 'rule_name', $this->description],
                ]);
            }

            $time_search_array = self::formatSearchTime($this->time_field, $this->start_time, $this->end_time);
            if ($time_search_array) {
                foreach ($time_search_array as $where) {
                    $query->andWhere($where);
                }
            }

            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
