<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function index() {
        $this->template->load('defaults', 'how_to_shop');
    }

}

?>