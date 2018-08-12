<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Shop_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('inventory_model');
    }
    public function get_all()
    {
        $this->db->from('shop');
        $this->db->join('items', 'shop.item_id = items.id', 'left');
        $result = $this->db->get()->result();
        $shop = array(
            'hats' => array(),
            'trees' => array(),
            'beds' => array(),
            'land' => array()
        );
        $shop['hats'] = array_filter($result, function($thing) {
            return $thing->type == 'h';
        }, ARRAY_FILTER_USE_BOTH);
        $shop['trees'] = array_filter($result, function($thing) {
            return $thing->type == 't';
        }, ARRAY_FILTER_USE_BOTH);
        $shop['beds'] = array_filter($result, function($thing) {
            return $thing->type == 'b';
        }, ARRAY_FILTER_USE_BOTH);
        $shop['land'] = array_filter($result, function($thing) {
            return $thing->type == 'l';
        }, ARRAY_FILTER_USE_BOTH);

        $shop = array_map('array_values', $shop);

        return $shop;
    }

    public function get_by_item_id($item_id)
    {
        $this->db->from('shop');
        $this->db->where('shop.item_id', $item_id);
        $this->db->join('items', 'shop.item_id = items.id', 'left');
        $product = $this->db->get()->first_row();

        return $product;
    }

    public function buy($user_id, $item_id)
    {
        $product = $this->shop_model->get_by_item_id($item_id);
        if($this->currency_model->take_beans($user_id, $product->price)) {
            return $this->inventory_model->add($user_id, $item_id);
        }
        return false;
    }
}