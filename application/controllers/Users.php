<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('user_model');
        $this->load->model('product_model');
        $this->load->helper('currency_helper');
    }

	public function index()
	{
        echo '<pre>';
        echo "Count of all active and verified users: ", count($this->user_model->get_verified_users(true)), PHP_EOL;
        echo "Count of active and verified users who have attached active products: ", count($this->user_model->get_verified_users_products(true)), PHP_EOL;
        echo "Count of all active products: ", count($this->product_model->get_all_products(true)), PHP_EOL;
        echo "Count of active products which don't belong to any user: ", count($this->product_model->get_products_without_users()), PHP_EOL;
        echo "Amount of all active attached products: ", ($this->product_model->amount_of_active_products()), PHP_EOL;
        echo "Summarized price of all active attached products: ", ($this->product_model->sum_price_active_products()), PHP_EOL;
        echo "Summarized prices of all active products per user: " . PHP_EOL;
        foreach ($this->product_model->active_products_by_user() as $entry) {
            echo "\t", $entry['username'], ": ", $entry['total'], PHP_EOL;
        }
        echo '</pre>';
        echo "<hr>";
        echo "<pre>";
            echo "1 USD => ", get_exchange_rate("USD", "EUR", 1), " EUR", PHP_EOL;
            echo "1 RON => ", get_exchange_rate("RON", "EUR", 1), " EUR", PHP_EOL;
        echo "</pre>";
	}
}
