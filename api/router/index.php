<?php 

/* https://marulanda.me/building-a-php-router/ */

class Router {

   protected $base_path;
   protected $request_uri;
   protected $request_method;
   protected $http_methods = array('get', 'post', 'put', 'patch', 'delete');

   function __construct($base_path = '') {
      $this->base_path = $base_path;

      // Remove query string and trim trailing slash
      $this->request_uri = rtrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');
      $this->request_method = $this->_determine_http_method();
   }

   private function _determine_http_method() {
      $method = strtolower($_SERVER['REQUEST_METHOD']);

      if (in_array($method, $this->http_methods)) return $method;
      return 'get';
   }

   public function respond($method, $route, $callable) {
    $method = strtolower($method);
 
    if ($route == '/') $route = $this->base_path;
    else $route = $this->base_path . $route;
 
    if ($method == $this->request_method && $route == $this->request_uri) {
       call_user_func_array($callable, array());
    }
 }

}