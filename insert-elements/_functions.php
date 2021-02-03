<?php 

//Idioma a usar (default español si no hay ninguno seleccionado)
//Declara la variable $lang con un valor especifico para determinar el idioma actual
if($_SESSION['lang']==''){ $_SESSION['lang']='es'; $lang='es'; }else{ $lang=$_SESSION['lang']; }

/*============================
┌─┐┌─┐┌┬┐   ┌─┐┌─┐┌─┐┬─┐┌┬┐┌─┐
│ ┬├┤  │    │  │ ││ │├┬┘ ││└─┐
└─┘└─┘ ┴────└─┘└─┘└─┘┴└──┴┘└─┘
*/
//OBTENER COORDENADAS DE UN LINK DE GOOGLE MAPS
//https://www.google.com.mx/maps/@20.9817112,-89.6152666,15z?hl=es  ->  20.9817112,-89.6152666
//Tambien se podría extraer el zoom pero hay que modificar el script
//Puede recibir una url un ifram o solo las coordenadas y devuelve siempre las coordenadas de la url
if( !function_exists('get_coords') ){
    function get_coords($url){
        $url = trim($url); //Eliminar espacios al inicio o final
        //Iframe
        //Detectar si ya viene con un iframe no hacer nada solo devolver solo el mapa con su iframe
    	preg_match("/iframe/", $url, $iframe);
    	if(count($iframe)>=1){
    		$is_iframe = true;
    		$coords  = $url;

    	}else{
    			//URL
    			//con el formato http://maps.google.com/maps/@4324,-34324,23z/?adasd=asdas etc. tipo URL
    			preg_match("/@(.*)?z/", $url, $tipo_url);
    			preg_match("/http/", $url, $have_http);
    			if($tipo_url[1]!='' && count($have_http)>=1){
    				$coordenadas = explode(",", $tipo_url[1]);
    				$coords =  $coordenadas[0].','.$coordenadas[1];
    				$is_url=true;
    			}	
    	}
    	//SIMPLES CORRDENADAS 390284932,-234234324
    	if(!$is_iframe && !$is_url && $url!=''){
    		$coords = $url;
    	}
    	return $coords;
    }
}


/*========================================================
┌─┐┌─┐┌┬┐   ┌┬┐┌─┐┌─┐  ┬  ┌─┐┌┬┐  ┬  ┌─┐┌┐┌   ┌─┐┌─┐┌─┐┌┬┐
│ ┬├┤  │    │││├─┤├─┘  │  ├─┤ │   │  │ ││││   ┌─┘│ ││ ││││
└─┘└─┘ ┴────┴ ┴┴ ┴┴    ┴─┘┴ ┴ ┴┘  ┴─┘└─┘┘└┘┘  └─┘└─┘└─┘┴ ┴
To get map data from CMS in many flavors, only lat, only lon, only zoom, lat and lon.
*/
if( !function_exists('get_map_lat_lon') ){
    function get_map_lat_lon($string){
        $map_data = explode("|",$string);
    	return $map_data[0];
    }
}
if( !function_exists('get_map_lat') ){
    function get_map_lat($string){
    	$map_data = explode("|",$string);
    	$map_latlon = explode(",",$map_data[0]);
    	return $map_latlon[0];
    }
}
if( !function_exists('get_map_lon') ){
    function get_map_lon($string){
    	$map_data = explode("|",$string);
    	$map_latlon = explode(",",$map_data[0]);
    	return $map_latlon[1];
    }
}
if( !function_exists('get_map_zoom') ){
    function get_map_zoom($string){
    	$map_data = explode("|",$string);
    	return $map_data[1];
    }
}



/*==============================
┌─┐┌┬┐┌┐ ┌─┐┌┬┐   ┬  ┬┬┌┬┐┌─┐┌─┐
├┤ │││├┴┐├┤  ││   └┐┌┘│ ││├┤ │ │
└─┘┴ ┴└─┘└─┘─┴┘────└┘ ┴─┴┘└─┘└─┘
*/
//GET EMBED VIDEO (youtube & vimeo)
//Devuelve el iframe de un video cualquiera que sea la estructura recibida, solo la url o un iframe como tal
if( !function_exists('embed_video') ){
    function embed_video($video){
        //Detectar si ya viene con un iframe no hacer nada solo devolver el video
    	preg_match("/iframe/", $video, $video_detect);
        if(count($video_detect)>=1){
        	return $video;
        }else{
        	//Youtube
        	preg_match("/youtube/", $video, $youtube);
        	if( count($youtube)>=1 ){ 
    			$step1=explode('v=', $video);
    			$step2 =explode('&',$step1[1]);
    			$vedio_id = $step2[0];
    			return '<iframe width="320" height="240" src="http://www.youtube.com/embed/'. $vedio_id.'" frameborder="0"></iframe>';
    		}
    		//Vimeo
    		preg_match("/vimeo/", $video, $vimeo);
    		if( count($vimeo)>=1 ){ 
    			$vedio_id = str_replace('http://vimeo.com/','',$video); //http
    			$vedio_id = str_replace('https://vimeo.com/','',$video); //https
    			return '<iframe width="320" height="240" src="https://player.vimeo.com/video/'.$vedio_id.'" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" frameborder="0"></iframe>';
    		}
        }
    }
}



/*=============
┌┬┐┬─┐┌─┐┌┐┌┌─┐
 │ ├┬┘├─┤│││└─┐
 ┴ ┴└─┴ ┴┘└┘└─┘
*/
//IDIOMA
//Funcion para traducir
 if( !function_exists('trans') ){
    function trans($es, $en, $lang_choosed){
        //ES (spanish default)
        if($lang_choosed == 'es' or $lang_choosed == ''){
            return stripslashes($es);
        }
        //EN (english)
        if($lang_choosed == 'en'){
            return stripslashes($en);
        }    
    }
}

/*==================================================
┌─┐┌─┐┌┬┐┬ ┬   ┬   ┌─┐┬ ┬┬─┐┬─┐┌─┐┌┐┌┌┬┐   ┬ ┬┬─┐┬  
├─┘├─┤ │ ├─┤  ┌┼─  │  │ │├┬┘├┬┘├┤ │││ │    │ │├┬┘│  
┴  ┴ ┴ ┴ ┴ ┴  └┘   └─┘└─┘┴└─┴└─└─┘┘└┘ ┴────└─┘┴└─┴─┘
*/
//PATH
//Obtiene la ruta del dominio _path y la ruta en la que se está navegando actualmente _path_browsing
$base_domain = $_SERVER['HTTP_HOST'];  
$base_uri = "//" . $base_domain . $_SERVER['PHP_SELF'];
$base_path_info = pathinfo($base_uri);

if( !defined('PATH') ){ define("PATH", $base_path_info['dirname']); }
if( !defined('DOMAIN_NAME') ){ define("DOMAIN_NAME", $base_domain); }
if( !defined('CURRENT_URL') ){ define("CURRENT_URL", "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); }
if( !defined('BASE_HREF') ){ define("BASE_HREF", $base_path_info['dirname']."/"); }

$path = $base_path_info['dirname'];
$domain_name = $base_domain;
$current_url = "//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$base_href = $base_path_info['dirname']."/";




/*==========
┌─┐┬  ┬ ┬┌─┐
└─┐│  │ ││ ┬
└─┘┴─┘└─┘└─┘
*/
//SLUG
//Genera un slug de una cadena por ejemplo: La piña es una fruta = la-pina-es-una-fruta
if( !function_exists('slug') ){
    setlocale(LC_ALL, 'en_US.UTF8');
    function slug($str, $replace=array(), $delimiter='-') {
        $str = trim($str);
    	if( !empty($replace) ) {
    		$str = str_replace((array)$replace, ' ', $str);
    	}
    	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    	$clean = strtolower(trim($clean, '-'));
    	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
    	return $clean;
    }
}

/*==========
┌┐┌┌─┐┌┐ ┬─┐
││││ │├┴┐├┬┘
┘└┘└─┘└─┘┴└─
*/
//ELIMINAR BR DE INICIO Y FIN DE STRING
if( !function_exists('nobr') ){
    function nobr($string){
    	return preg_replace('/^(?:<br\s*\/?>\s*)/', '', $string);
    }
}

/*===============
┌┬┐┌─┐┬  ┬┬┌─┐┌─┐
 ││├┤ └┐┌┘││  ├┤ 
─┴┘└─┘ └┘ ┴└─┘└─┘
*/
//IDENTIFICAR DISPOSITIVO
$dispositivo = strtolower($_SERVER['HTTP_USER_AGENT']);
if(stripos($dispositivo,'ipad')){
    $tablet = true;
    $ipad = true;
}else if(stripos($dispositivo,'iphone') or ( stripos($dispositivo,'android') && stripos($dispositivo,'mobile') ) ){
    $mobile = true;
    $telefono = true;
    $iphone = true;
    $android = true;
}else{
    $pc = true;
}
//FORZAR CUANDO SE TRABAJA EN LOCAL
//$telefono = false;
//$tablet = true;
//$pc = false;



/*======================
┌─┐┌─┐┌┬┐   ┌┬┐┌─┐┌┬┐┌─┐
│ ┬├┤  │     ││├─┤ │ ├┤ 
└─┘└─┘ ┴─────┴┘┴ ┴ ┴ └─┘
*/
//CONVERTIR UNA FECHA A FORMATO EN ESPAÑOL
/*
    Algunos ejemplos de salida
    ----------------------------------------
    F j, Y g:i a - November 6, 2010 12:50 am
    F j, Y - November 6, 2010
    F, Y - November, 2010
    g:i a - 12:50 am
    g:i:s a - 12:50:48 am
    l, F jS, Y - Saturday, November 6th, 2010
    M j, Y @ G:i - Nov 6, 2010 @ 0:50
    Y/m/d \a\t g:i A - 2010/11/06 at 12:50 AM
    Y/m/d \a\t g:ia - 2010/11/06 at 12:50am
    Y/m/d g:i:s A - 2010/11/06 12:50:48 AM
    Y/m/d - 2010/11/06

*/
if( !function_exists('get_date') ){

    function get_date($fecha){
    	$nd = explode(" ",$fecha); //Recibe 0000-00-00 00:00:00
    	switch (date('w', strtotime( $nd[0] ))){ //Formato 0000-00-00
    	    case 0: $nombredia = trans("Domingo","Sunday",$_SESSION['lang']); break;
    	    case 1: $nombredia = trans("Lunes","Monday",$_SESSION['lang']); break;
    	    case 2: $nombredia = trans("Martes","Tuesday",$_SESSION['lang']); break;
    	    case 3: $nombredia = trans("Miercoles","Wednesday",$_SESSION['lang']); break;
    	    case 4: $nombredia = trans("Jueves","Thursday",$_SESSION['lang']); break;
    	    case 5: $nombredia = trans("Viernes","Friday",$_SESSION['lang']); break;
    	    case 6: $nombredia = trans("Sábado","Saturday",$_SESSION['lang']); break;
    	}
    	$ddate = date_create( $fecha ); 
    	$array_meses_ingles = array('January','February','March','April','May','June','July','August','September','October','November','December');
    	$array_meses_spanish = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
    	if( $_SESSION['lang']==''  or $_SESSION['lang']=='es' ){
    		$fecha_return = $nombredia.' '.str_replace($array_meses_ingles, $array_meses_spanish, date_format($ddate, 'd  \d\e  F \d\e  Y') );
    	}
    	if($_SESSION['lang']=='en'){
    		$fecha_return = date_format($ddate, 'F j, Y');
    	}
    	return $fecha_return;
    }
}

/*=======================================
┌─┐┬  ┬┌─┐┌─┐       ┌─┐┌─┐┌─┐┬─┐┌┬┐┌─┐┬─┐
└─┐│  ││  ├┤   ───  ├─┤│  │ │├┬┘ │ ├─┤├┬┘
└─┘┴─┘┴└─┘└─┘       ┴ ┴└─┘└─┘┴└─ ┴ ┴ ┴┴└─
*/
//RECORDAR UNA CADENA PONER SUSPENSIVOS EN DETERMINADA CANTIDAD DE TEXTO
if( !function_exists('slice') ){
    function slice($cadena, $limite, $corte=" ", $pad="...") {
        //devuelve la cadena sin cambios si la palabra es mas corta que el limite
        if(strlen($cadena) <= $limite)
            return $cadena;
        // is $break present between $limit and the end of the string? 
        if(false !== ($breakpoint = strpos($cadena, $corte, $limite))) {
            if($breakpoint < strlen($cadena) - 1) {
                $cadena = substr($cadena, 0, $breakpoint) . $pad;
            }
        }
        return $cadena;
        //acortar($str, 21, " ", "...")
    }
}

/*====================
┌─┐─┐ ┬┌─┐┌─┐┬─┐┌─┐┌┬┐
├┤ ┌┴┬┘│  ├┤ ├┬┘├─┘ │ 
└─┘┴ └─└─┘└─┘┴└─┴   ┴ 
*/
//OBTENER RESUMEN DE PUBLICACION A PARTIR DE RECORTAR UNA CADENA DONDE APAREZCA EL PRIMER <-- pagebreak -->
if( !function_exists('get_excerpt') ){
    function get_excerpt($string){
        if( preg_match("/<!-- pagebreak -->/",$string,$output) ){
    		$excerpt_return = explode("<!-- pagebreak -->",stripslashes( $string ));
    		return $excerpt_return[0];
    	}else{
    		return slice($string,420, ' ', '');
    	}
    }
}


/*=========================
┬┌┐┌ ┬┌─┐┌─┐┌┬┐┌─┐┌┐ ┬  ┌─┐
││││ │├┤ │   │ ├─┤├┴┐│  ├┤ 
┴┘└┘└┘└─┘└─┘ ┴ ┴ ┴└─┘┴─┘└─┘
*/
if( !function_exists('injectable') ){
    function injectable($string){
        //Prevent SQL injection by REGEXP
    	//All characters are permited except "spaces, quotes of any type, and reserved words of SQL Queries"
    	//The "<script>" validation is for XSS Cross Site Scripting
    	if( preg_match("/script>|<\/script>|\s|`|´|'|\"|\sAND|\sOR|\sDROP|\sTRUNCATE|\sDELETE|\sINSERT|\sSELECT|\sUNION|AND\s|OR\s|DROP\s|TRUNCATE\s|DELETE\s|INSERT\s|SELECT\s|UNION\s|GROUP_CONCAT|INFORMATION_SCHEMA|TABLE_SCHEMA/i", $string, $output_array) ){
    		return true;
    	}
    }
}


/*==============
┌─┐┌─┐┌┬┐   ┬┌─┐
│ ┬├┤  │    │├─┘
└─┘└─┘ ┴────┴┴  
*/
// Function to get the client IP address
//http://stackoverflow.com/questions/15699101/get-the-client-ip-address-using-php
if( !function_exists('get_ip') ){
    function get_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}


/*================================================================================================
┌─┐┌─┐┌─┐   ┌┬┐┬┌┬┐┬  ┌─┐       ┌─┐┌─┐┌─┐    ┌┬┐┌─┐┌─┐┌─┐┬─┐┬┌─┐┌┬┐┬┌─┐┌┐┌
└─┐├┤ │ │    │ │ │ │  ├┤   ───  └─┐├┤ │ │     ││├┤ └─┐│  ├┬┘│├─┘ │ ││ ││││
└─┘└─┘└─┘────┴ ┴ ┴ ┴─┘└─┘       └─┘└─┘└─┘─────┴┘└─┘└─┘└─┘┴└─┴┴   ┴ ┴└─┘┘└┘
*/
if( !function_exists('get_title') ){
    function get_title($default_title="", $seo_title=""){
        if( $default_title!='' ){
            $response = strip_tags(stripslashes( $default_title ));
    	}
    	if( $seo_title!=''){
    		$response = strip_tags(stripslashes( $seo_title ));
    	}
    	return $response;
    }
}

if( !function_exists('get_description') ){
    function get_description($default_description="",$seo_description=""){
    	if( $default_description!='' ){
    		$response = htmlspecialchars(strip_tags(stripslashes($default_description)));
    	}
    	if( $seo_description!=''){
    		$response = htmlspecialchars(strip_tags(stripslashes($seo_description)));
    	}
    	return substr($response,0,250);
    }
}


/*================================================================================================
┌─┐┌─┐┌┬┐     ┬┌┬┐┌─┐┌─┐┌─┐┌─┐
│ ┬├┤  │      ││││├─┤│ ┬├┤ └─┐
└─┘└─┘ ┴ ─── ─┴┴ ┴┴ ┴└─┘└─┘└─┘
Obtener las imagenes y datos de un campo con multiples imagenes
Recibe un string con formato imagen.jpg¬texto linea 01 [enter] texto linea 02 | imagen.jpg....
Devuelve un array con el nombre de la imagen, y los datos del campo de texto por linea en caso de tenerlos, sino, solo devuelve el nombre de la imagen y los rows vacíos
De este modo el campo de texto adjunto puede usarse o no, y se pueden usar los textos de cada línea de forma individual
*/
if( !function_exists('get_images') ){
    function get_images($string){

        $images = explode("|",$string);
    	foreach ($images as $im) {
    		$slide_image = explode("¬",$im);
    		$slide_data = explode(PHP_EOL, $slide_image[1]);

    		//Store results
    		$image = $slide_image[0];//<---- Image
    		$row01 = $slide_data[0];
    		$row02 = $slide_data[1];
    		$row03 = $slide_data[2];
    		$row04 = $slide_data[3];
    		$row05 = $slide_data[4];

    		$array_return[] = array("image"=>$image, "row01"=>$row01, "row02"=>$row02, "row03"=>$row03, "row04"=>$row04, "row05"=>$row05);
    	}
    	return $array_return;

    }
}

/*================================================================================================
┌─┐┌─┐┌┬┐   ┌─┐─┐ ┬┌─┐┬  ┌─┐┌┬┐┌─┐
│ ┬├┤  │    ├┤ ┌┴┬┘├─┘│  │ │ ││├┤ 
└─┘└─┘ ┴────└─┘┴ └─┴  ┴─┘└─┘─┴┘└─┘
Obtener un array mediante la funcion explode, ejemplo:
De una lista de emails: 'email@dom.com, correo@dom.com'
Solo mostrar el primero con echo get_explode($datos['emails'],',')[0];
Devuelve: 'email@dom.com';
Esta funcion es muy util cuando se quiere obtener un array de una lista dividida con cualquier separador , |, etc
*/
if( !function_exists('get_explode') ){
    function get_explode($string, $separator){
        $explode_string = explode("$separator", $string);
    	return $explode_string;
    }
}

/*================================================================================================
┬ ┬┌─┐─┐ ┬  ┌┬┐┌─┐  ┬─┐┌─┐┌┐ ┌─┐
├─┤├┤ ┌┴┬┘   │ │ │  ├┬┘│ ┬├┴┐├─┤
┴ ┴└─┘┴ └─   ┴ └─┘  ┴└─└─┘└─┘┴ ┴
Convert hex color to rgba string
http://mekshq.com/how-to-convert-hexadecimal-color-code-to-rgb-or-rgba-using-php/
usage:
$color = '#ffa226';
$rgb = hex2rgba($color);
$rgba = hex2rgba($color, 0.7)
*/
if( !function_exists('hex2rgba') ){
    function hex2rgba($color, $opacity = false) {
     
        $default = 'rgb(0,0,0)';
     
    	//Return default if no color provided
    	if(empty($color))
              return $default; 
     
    	//Sanitize $color if "#" is provided 
            if ($color[0] == '#' ) {
            	$color = substr( $color, 1 );
            }
     
            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                    return $default;
            }
     
            //Convert hexadec to rgb
            $rgb =  array_map('hexdec', $hex);
     
            //Check if opacity is set(rgba or rgb)
            if($opacity){
            	if(abs($opacity) > 1)
            		$opacity = 1.0;
            	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
            	$output = 'rgb('.implode(",",$rgb).')';
            }
     
            //Return rgb(a) color string
            return $output;
    }
}

/*================================================================================================
┌─┐┌┬┐┌─┐┬┬     ┬  ┬┌─┐┬  ┬┌┬┐┌─┐┌┬┐┌─┐
├┤ │││├─┤││     └┐┌┘├─┤│  │ ││├─┤ │ ├┤ 
└─┘┴ ┴┴ ┴┴┴─┘────└┘ ┴ ┴┴─┘┴─┴┘┴ ┴ ┴ └─┘
*/
//Funcion para validar email
if( !function_exists('email_validate') ){
    function email_validate($pMail) { 
        // Usuario: moz
        if (ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([_a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]{2,200}\.[a-zA-Z]{2,6}$", $pMail ) ) {
           return true;
        } else {
           return false;
        }
    }
}

/*================================================================================================
┌┬┐┌─┐┬┌─┌─┐┌┐┌
 │ │ │├┴┐├┤ │││
 ┴ └─┘┴ ┴└─┘┘└┘
*/
//Generate Token
if( !function_exists('token') ){
    function token($longitud,$tipo="alfanumerico"){ 
        if ($tipo=="alfanumerico"){ 
            $exp_reg="/[^A-Z0-9]/i"; 
        } elseif ($tipo=="numerico"){ 
            $exp_reg="[^0-9]"; 
        } 
        return substr(preg_replace($exp_reg, "", md5(rand())) . 
           preg_replace($exp_reg, "", md5(rand())) . 
           preg_replace($exp_reg, "", md5(rand())), 
           0, $longitud); 
    }
}


/*================================================================================================
┬┌─┐    ┬  ┌─┐┌─┐┌─┐┬  ┬ ┬┌─┐┌─┐┌┬┐
│└─┐    │  │ ││  ├─┤│  ├─┤│ │└─┐ │ 
┴└─┘────┴─┘└─┘└─┘┴ ┴┴─┘┴ ┴└─┘└─┘ ┴ 
*/
//Saber si estas en localhost
if( !function_exists('is_localhost') ){
    function is_localhost(){
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );
        if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
            return true;
        }else{
            return false;
        }
    }
}


/*================================================================================================
┬┌─┐  ┬ ┬┌┬┐┌┬┐┌─┐┌─┐
│└─┐  ├─┤ │  │ ├─┘└─┐
┴└─┘  ┴ ┴ ┴  ┴ ┴  └─┘
*/
//http://stackoverflow.com/questions/1175096/how-to-find-out-if-youre-using-https-without-serverhttps
if( !function_exists('isHttps') ){
    function isHttps() {
      return
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || $_SERVER['SERVER_PORT'] == 443;
    }
}
?>