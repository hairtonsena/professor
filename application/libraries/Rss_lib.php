<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rss_lib
 *
 * @author hairton
 */
class Rss_lib {

    public function __construct() {
        
    }

    /**
     * 
     * @return type
     */
    public function carregarRRS($link) {

        if ($link != NULL) {
            $xml = simplexml_load_file($link)->channel;
            return $xml;
        }
    }

    //put your code here
}
