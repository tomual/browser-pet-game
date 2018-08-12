<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Item_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_all()
    {
        $this->db->from('items');
        $result = $this->db->get()->result();
        $items = array(
            'hats' => array(),
            'trees' => array(),
            'beds' => array(),
            'land' => array()
        );
        $items['hats'] = array_filter($result, function($thing) {
            return $thing->type == 'h';
        }, ARRAY_FILTER_USE_BOTH);
        $items['trees'] = array_filter($result, function($thing) {
            return $thing->type == 't';
        }, ARRAY_FILTER_USE_BOTH);
        $items['beds'] = array_filter($result, function($thing) {
            return $thing->type == 'b';
        }, ARRAY_FILTER_USE_BOTH);
        $items['land'] = array_filter($result, function($thing) {
            return $thing->type == 'l';
        }, ARRAY_FILTER_USE_BOTH);

        $items = array_map('array_values', $items);

        return $items;
    }

    public function get($id)
    {
        $this->db->from('items');
        $this->db->where('id', $id);
        $item = $this->db->get()->first_row();

        return $item;
    }
}