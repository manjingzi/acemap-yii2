<?php

namespace backend\modules\user\search;

use yii\data\ActiveDataProvider;
use common\models\User;

class UserSearch extends User {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $start_time;
    public $end_time;
    private $time_field = 'created_at';

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status'], 'integer'],
            [['start_time', 'end_time'], 'date']
        ];
    }

    public function search($params) {
        $query = User::find();

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'username', $this->keyword],
                    ['like', 'email', $this->keyword]
                ]);
            }

            $time_search_array = self::formatSearchTime($this->time_field, $this->start_time, $this->end_time);
            if ($time_search_array) {
                foreach ($time_search_array as $where) {
                    $query->andWhere($where);
                }
            }

            if ($this->status) {
                $query->andWhere(['status' => $this->status]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
