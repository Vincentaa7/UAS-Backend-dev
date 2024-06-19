<?php
class Cors
{
	public function handle($request, $next)
	{
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Athorization, X-Request-With");

		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') 
		{
			http_response_code(200);
			exit();
		}

		return $next($request);
	}
}