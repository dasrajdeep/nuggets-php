<?php
class Registry {
	
	//list of engine specific routes
	private static $engine_routes=array("master","config","saveconfig");
	//array containing the routes defined by designer
	private static $routes=array(
		'default'=>array("Default","loadDefaultView"),
		'master'=>array("Default","loadDefaultView")
	);
	
	private static $paths=array(
		"datastore"=>"datastore/",
		"view"=>"app/view/",
		"jquery"=>"vendor/jquery.js",
		"jqueryui"=>"vendor/jquery-ui/",
		"base64"=>"vendor/base64.js",
		"uploader"=>"vendor/valums/",
		"scriptlib"=>"core/view/scriptlib/"
	);
	
	public static function init() {
		$config=parse_ini_file('app/app.ini',true);
		
		$route_keys=array_keys($config['ROUTES']);
		$path_keys=array_keys($config['PATHS']);
		
		foreach($route_keys as $k) {
			if(in_array($k,self::$engine_routes)) continue;
			$set=explode(':',$config['ROUTES'][$k]);
			self::$routes[$k]=array($set[0],$set[1]);
		}
		
		foreach($path_keys as $k) self::$paths[$k]=$config['PATHS'][$k];
	}

	public static function isEngineCommand($command) {
		return in_array($command, self::$engine_routes);
	}
	
	public static function getPath($resource) {
		if(array_key_exists($resource,self::$paths)) return self::$paths[$resource];
		else return null;
	}
	
	public static function getRoute($command) {
		if(array_key_exists($command,self::$routes)) return self::$routes[$command];
		else return self::$routes['default'];
	}
}

?>
