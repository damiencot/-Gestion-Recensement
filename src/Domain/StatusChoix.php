<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace MicroCMS\Domain;

/**
 * Description of StatusCohoix
 *
 * @author thouars
 */
class StatusChoix {
    
    
    private $status = true;
    
    
      function __construct() {
        $this->status = true ;
    }
    
    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }


}
