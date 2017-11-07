<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gamification extends CI_Controller {

    public function author_badges_page() {
        $this->template->load('page', 'community_badges');
    }

    public function badges() {
        $this->template->load('page', 'badges');
    }

    public function flag_badges() {
        $this->template->load('page', 'flag_badges');
    }

    public function badges_boxes() {
        $this->template->load('page', 'badges_boxes');
    }

    public function author_badges() {
        $this->template->load('defaults', 'author_badges');
    }

}

?>