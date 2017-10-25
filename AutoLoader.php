<?php

namespace allekurier\api_v1;

/**
 * @author it@allekurier.pl
 */
class AutoLoader
{
	/**
	 * @param string $baseDir
	 */
	public static function init($baseDir)
	{
		$baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR);

		spl_autoload_register(function($className) use ($baseDir) {
			$file = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

			require_once $baseDir . DIRECTORY_SEPARATOR . $file;
		});
	}
}
