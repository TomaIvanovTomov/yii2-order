<?php

namespace tomaivanovtomov\order\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrderSearch represents the model behind the search form of `app\models\Order`.
 */
class OrderSearch extends Order
{
    public $email;
    public $first_name;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payment_type', 'currency_id', 'status'], 'integer'],
            [['more_info', 'date_receive', 'date_send', 'ip', 'status', 'way_bill', 'email', 'first_name'], 'safe'],
            [['discount', 'sum', 'delivery', 'total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Order::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_receive' => $this->date_receive,
            'date_send' => $this->date_send,
            'discount' => $this->discount,
            'sum' => $this->sum,
            'delivery' => $this->delivery,
            'total' => $this->total,
            'payment_type' => $this->payment_type,
            'currency_id' => $this->currency_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'more_info', $this->more_info])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'way_bill', $this->way_bill])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'first_name', $this->first_name]);

        return $dataProvider;
    }
}
