<?php


class Router
{
  private $request;
  private $supportedHttpMethods = array(
    "GET",
    "POST",
    "PUT",
    "DELETE",
    "OPTIONS",
    "PATCH"
    
  );

  function __construct(IRequest $request)
  {
   $this->request = $request;
  }

  function __call($name, $args)
  {
    
    
    list($route, $method) = $args;

    if(!in_array(strtoupper($name), $this->supportedHttpMethods))
    {
      $this->invalidMethodHandler();
    }

    $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
  }

  /**
   * Removes trailing forward slashes from the right of the route.
   * @param route (string)
   */
  private function formatRoute($route)
  {

    $result = rtrim($route, '/');
  
    if ($result === '')
    {
      return '/';
    }

    return $result;
  }

  /**
   * @author Once
   */
  private function fomatInputRoute($route){
    $result = rtrim($route, '/');
    
    if ($result === '')
    {
      return '/';
    }

    $root = '/(\/API)(\/[A-Za-z]+\/?)/';
    $some = '/\/[0-9]+/';

    preg_match($root, $route, $rootMatches);
    preg_match($some, $route, $someMatches);

    $letter = str_replace($rootMatches[0],"", $route);
    
    if(strlen($letter) == 0){
      
      $route = $rootMatches[2];
    }
    else if(sizeof($someMatches) > 0){
        $extra = '/[0-9]+/';
        
        preg_match($extra, $someMatches[0], $extraMatches);

        strpos($route, $extraMatches[0]);

        $originalRoute = str_replace($extraMatches[0],"?", $route);
        $originalRoute = str_replace('/API', '', $originalRoute);
        
        $route = str_replace('/API', '', $route);
        
        return [ $originalRoute, $route ];
    }
    else if(sizeof($rootMatches) > 2){
       $route = str_replace('/API', '', $route);
    }
    else if(substr_count($route, '/') > 2){
      $position = strrpos($route, '/');

       $route = substr_replace($route, '', $position, 1);
    }

    return [ $route ];

  }

  private function invalidMethodHandler()
  {
    header("{$this->request->serverProtocol} 405 Method Not Allowed");
  }

  private function defaultRequestHandler()
  {
    header("{$this->request->serverProtocol} 404 Not Found");
  }

  /**
   * Resolves a route
   */
  function resolve()
  {

    $methodDictionary = $this->{strtolower($this->request->requestMethod)};
    $formatedRoute = $this->fomatInputRoute($this->request->requestUri);
    if(!isset($methodDictionary[ $formatedRoute[0] ])){
      
      echo json_encode($formatedRoute);
      $this->defaultRequestHandler();
      
      http_response_code(404);
      echo json_encode('404 NOT FOUND');
      return json_encode($methodDictionary);
    }
    
    $method = $methodDictionary[ $formatedRoute[0] ];

    echo call_user_func_array($method, array($this->request));
  }

  function __destruct()
  {
    $this->resolve();
  }
}