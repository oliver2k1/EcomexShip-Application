<?php 
class Request {
    private $params;
    
    public function __construct($params) {
      $this->params = $params;
    }
    
    public function get($name) {
      return isset($this->params[$name]) ? $this->params[$name] : null;
    }
  }
?>