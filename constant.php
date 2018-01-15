<?php 
	define('SECRET_KEY', 'mysecretkey');
	define('CHECK_TOKEN_SUCCESS', 0);
	define('CHECK_TOKEN_ERR_PARAM', 1);
	define('CHECK_TOKEN_ERR_SECRET_KEY', 2);
	define('CHECK_TOKEN_ERR_TOKEN_NOT_EXIST', 3);
	define('CHECK_TOKEN_ERR_TOKEN_EXPIRE', 4);

	define('RESET_TOKEN_LOGOUT', 0);
	define('RESET_TOKEN_RESET', 1);
	define('RESET_TOKEN_SUCCESS', 1);
	define('RESET_TOKEN_FALSE', 0);
?>