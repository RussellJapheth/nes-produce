<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    /**
     * get_all_products
     * Get all products in the sytem
     *
     * @param boolean $only_active return only active products
     * @return array
     */
    public function get_all_products($only_active = true)
    {
        if($only_active) {
            $this->db->where('status', 1);
        }
        
        return $this->db->get('products')->result_array();
    }

    /**
     * get_products_without_users
     * Get products without active users
     *
     * @return array
     */
    public function get_products_without_users()
    {
        $query = $this->db->query("
            SELECT *
            FROM   products
            WHERE  NOT EXISTS
            (SELECT *
            FROM   user_products
            WHERE  user_products.product_id = products.id)");
            
            return $query->result_array();
    }

    /**
     * amount_of_active_products
     * Get the number of active products
     *
     * @return int
     */
    public function amount_of_active_products()
    {
        $sum = 0;

        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('products.status', 1);
        
        $this->db->join('user_products', 'user_products.user_id = products.id');
        
        $entries = $this->db->get()->result_array();

        if(empty($entries)) {
            return $sum;
        }

        array_map(function($entry) use(&$sum) {
            
            $sum += $entry['amount_in_stock'];

        }, $entries);

        return $sum;
    }

    /**
     * sum_price_active_products
     * Get the total cost of active products in stock
     *
     * @return int
     */
    public function sum_price_active_products()
    {
        $sum = 0;

        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('products.status', 1);
        
        $this->db->join('user_products', 'user_products.user_id = products.id');
        
        $entries = $this->db->get()->result_array();

        if(empty($entries)) {
            return $sum;
        }

        array_map(function($entry) use(&$sum) {
            
            $sum += $entry['amount_in_stock'] * $entry['price'];

        }, $entries);

        return $sum;
    }

    public function active_products_by_user()
    {
        $this->db->select('SUM(user_products.price) as total, users.username');
        $this->db->from('products');
        $this->db->where('products.status', 1);
        
        $this->db->join('user_products', 'user_products.user_id = products.id');
        $this->db->join('users', 'user_products.user_id = users.id');

        $this->db->group_by("users.id");
        
        return $this->db->get()->result_array();
    }
}