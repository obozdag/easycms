<?php
if ( ! function_exists('strtolower_tr'))
{
	function strtolower_tr($metin)
	{
		return mb_convert_case(str_replace('I','ı',$metin), MB_CASE_LOWER, 'UTF-8');
	}
}

if ( ! function_exists('strtoupper_tr'))
{
	function strtoupper_tr($metin)
	{
		return mb_convert_case(str_replace('i','İ',$metin), MB_CASE_UPPER, 'UTF-8');
	}
}

if ( ! function_exists('ucwords_tr'))
{
	function ucwords_tr($metin)
	{
		return mb_convert_case($metin, MB_CASE_TITLE, 'UTF-8');
	}
}

if ( ! function_exists('ucfirst_tr'))
{
	function ucfirst_tr($metin)
	{
		$metin = in_array(crc32($metin[0]),array(1309403428, -797999993, 957143474)) ? array(strtoupper_tr(substr($metin,0,2)),substr($metin,2)) : array(strtoupper_tr($metin[0]),substr($metin,1));

		return $metin[0].$metin[1];
	}
}

if ( ! function_exists('turkish_to_utf'))
{
	function turkish_to_utf($str)
	{
		$harfler = array(
			'ç'		=>	'Ã§',
			'ğ'		=>	'ÄŸ',
			'ı'		=>	'Ä±',
			'ö'		=>	'Ã¶',
			'ş'		=>	'ÅŸ',
			'ü'		=>	'Ã¼',
			'Ç'		=>	'Ã‡',
			'Ğ'		=>	'Äž',
			'İ'		=>	'Ä°',
			'Ö'		=>	'Ã–',
			'Ş'		=>	'Åž',
			'Ü'		=>	'Ãœ',
			'â€˜'	=>	'\''
		);

		return str_replace(array_keys($harfler), array_values($harfler), $str);
	}
}

if ( ! function_exists('utf_to_turkish'))
{
	function utf_to_turkish($str)
	{
		$harfler = array(
			'ç'		=>	'Ã§',
			'ğ'		=>	'ÄŸ',
			'ı'		=>	'Ä±',
			'ö'		=>	'Ã¶',
			'ş'		=>	'ÅŸ',
			'ü'		=>	'Ã¼',
			'Ç'		=>	'Ã‡',
			'Ğ'		=>	'Äž',
			'İ'		=>	'Ä°',
			'Ö'		=>	'Ã–',
			'Ş'		=>	'Åž',
			'Ü'		=>	'Ãœ',
			'â€˜'	=>	'\''
		);

		return str_replace(array_values($harfler), array_keys($harfler), $str);
	}
}

if ( ! function_exists('sql_latin1_to_utf8'))
{
	// Fields in Latin1 character set are converted to UTF8 character set
	function sql_latin1_to_utf8($table, $column_name, $column_value, $row_id)
	{
		$sql = "UPDATE ".$table." SET ".$column_name." = UNHEX('".bin2hex($column_value)."') WHERE id = ".$row_id;

		return $sql;
	}
}

if ( ! function_exists('turkish_to_ascii'))
{
	function turkish_to_ascii($str)
	{
		$harfler = array(
			'ç'		=>	'c',
			'ğ'		=>	'g',
			'ı'		=>	'i',
			'ö'		=>	'o',
			'ş'		=>	's',
			'ü'		=>	'u',
			'Ç'		=>	'C',
			'Ğ'		=>	'G',
			'İ'		=>	'I',
			'Ö'		=>	'O',
			'Ş'		=>	'S',
			'Ü'		=>	'U',
			'â€˜'	=>	'\''
		);

		return str_replace(array_keys($harfler), array_values($harfler), $str);
	}
}

if ( ! function_exists('echo_pre'))
{
	function echo_pre($str, $return = FALSE)
	{
		if($return)
		{
			return '<pre>' . print_r($str, TRUE) . '</pre>';
		}

		echo '<pre>';
		print_r($str);
		echo '</pre>';
	}
}

if ( ! function_exists('dd'))
{
	function dd($str, $return = FALSE)
	{
		if($return)
		{
			return '<pre>' . var_export($str, TRUE) . '</pre>';
		}

		echo '<pre>';
		var_export($str);
		echo '</pre>';
		die();
	}
}

if ( ! function_exists('del_tree'))
{
	function del_tree($dir)
	{
		if(is_dir($dir) || is_file($dir))
		{
			$dir_array = scandir($dir);

			if(is_array($dir_array))
			{
				$files = array_diff($dir_array, array('.','..'));

				foreach ($files as $file)
				{
					(is_dir("$dir/$file")) ? del_tree("$dir/$file") : unlink("$dir/$file");
				}

				return rmdir($dir);
			}
		}

		return FALSE;
	}
}

if ( ! function_exists('make_slug'))
{
	function make_slug($string) {
	    //Lower case everything
	    $string = strtolower_tr($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);

	    return $string;
	}
}
