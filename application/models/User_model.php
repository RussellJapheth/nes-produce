<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    /**
     * get_all_users
     * Get all the users in the system
     *
     * @return array
     */
    public function get_all_users()
    {
        return $this->db->get('users')->result_array();
    }

    /**
     * get_verified_users
     * Get all verified users in the sytem
     *
     * @param boolean $only_active return only active users
     * @return array
     */
    public function get_verified_users($only_active = true)
    {
        $this->db->where('is_verified', 1);
        
        if($only_active) {
            $this->db->where('is_active', 1);
        }
        
        return $this->db->get('users')->result_array();
    }

    
    /**
     * get_verified_users_products
     * Get all verified users in the sytem
     *
     * @param boolean $only_active return only active users
     * @return array
     */
    public function get_verified_users_products($only_active = true)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('users.is_verified', 1);
        
        if($only_active) {
            $this->db->where('users.is_active', 1);
        }
        
        $this->db->join('user_products', 'user_products.user_id = users.id');
        $this->db->join('products', 'products.id = user_products.product_id');

        $this->db->where('products.status', 1);
        
        return $this->db->get()->result_array();
    }
}