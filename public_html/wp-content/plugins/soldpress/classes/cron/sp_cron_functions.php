<?php
/**
 * @author 		Sanskript Solutions
 * @version     1.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; 

  function sp_pick()
  {
    $argc = func_num_args();
    for ($i = 0; $i < $argc; $i++) {
        $arg = func_get_arg($i);
        if (! is_null($arg)) {
            return $arg;
        }
    }

    return null;    
  }
  
  function sp_is_ajax() { 
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH']  == 'XMLHttpRequest'); 
  }
    
  function sp_is_unix()
  {
		return in_array(php_uname('s'), array('Linux', 'FreeBSD', 'OpenBSD', 'Darwin', 'SunOS', 'AIX'));
  }        
  
  // from Pear System::which, released under the PHP License
  // http://www.php.net/license/3_0.txt
  // slightly modified
  function sp_get_binary_path($program, $append = '', $fallback = null)
  { 
    $win = substr(PHP_OS, 0, 3) == 'WIN';
    
    // enforce API
    if (!is_string($program) || '' == $program) {
        return $fallback;
    }

    // available since 4.3.0RC2
    if (defined('PATH_SEPARATOR')) {
        $path_delim = PATH_SEPARATOR;
    } else {
        $path_delim = $win ? ';' : ':';
    }
    // full path given
    if (basename($program) != $program) {
        $path_elements[] = dirname($program);
        $program = basename($program);
    } else {
        // Honor safe mode
        if (!ini_get('safe_mode') || !$path = ini_get('safe_mode_exec_dir')) {
            $path = getenv('PATH');
            if (!$path) {
                $path = getenv('Path'); // some OSes are just stupid enough to do this
            }
        }
        $path_elements = explode($path_delim, $path);
    }

    if ($win) {
        $exe_suffixes = getenv('PATHEXT')
                            ? explode($path_delim, getenv('PATHEXT'))
                            : array('.exe','.bat','.cmd','.com');
        // allow passing a command.exe param
        if (strpos($program, '.') !== false) {
            array_unshift($exe_suffixes, '');
        }
        // is_executable() is not available on windows for PHP4
        $pear_is_executable = (function_exists('is_executable')) ? 'is_executable' : 'is_file';
    } else {
        $exe_suffixes = array('');
        $pear_is_executable = 'is_executable';
    }

    foreach ($exe_suffixes as $suff) {
        foreach ($path_elements as $dir) {
            $file = $dir . DIRECTORY_SEPARATOR . $program . $suff;
            if (@$pear_is_executable($file)) {
                return $file . $append;
            }
        }
    }
    return $fallback;
  }
  
  function sp_try_these()
  {
    $num = func_num_args();
    for($i = 0; $i < $num; $i++)
    {
      if(func_get_arg($i))
        return func_get_arg($i);
    }
  }
  
  function sp_every()
  {
    $num = func_num_args();
    for($i = 0; $i < $num; $i++)
    {
      if(! func_get_arg($i))
        return false;
    }
    return true;
  }
  
	
   
?>
