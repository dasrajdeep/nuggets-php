<?php
    class Router {
        
        //name of default route for the engine
        private static $default_route="default";
        //list of engine specific routes
        private static $engine_routes=array("master","config","saveconfig");
        //array containing the routes defined by designer
        private static $routes=array();
        
        public static function init() {
            self::$routes[self::$default_route]=array("Default","loadDefaultView");
            self::$routes["master"]=array("Default","loadDefaultView");
            self::$routes["config"]=array("Default","loadConfigView");
            self::$routes["saveconfig"]=array("Default","saveConfig");
        }

        public static function isEngineCommand($command) {
            return in_array($command, self::$engine_routes);
        }
        
        public static function connect($command,$entity,$action) {
            if(in_array($command, self::$engine_routes)) return FALSE;
            self::$routes[$command]=array($entity,$action);
            return TRUE;
        }
        
        public static function getRoute($command) {
            $route=self::$routes[$command];
            if($route==NULL) $route=self::$routes[self::$default_route];
            return $route;
        }
    }
?>
