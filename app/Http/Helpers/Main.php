<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;

class Main {

    public static function redirect( $url ) {
        header("Location: {$url}");
    }

    public static function functionError($FUNC) {
        return json_encode([
            'result' => 'FUNCTION-ERROR',
            'trigger' => $FUNC
        ]);
    }

     /**************************************************************
    *
    * FUNÇÕES ANTI INJECTION DE DADOS
    *
    **************************************************************/

    public static function protect($string) { $string = trim($string); $string =str_replace("'","",$string); $string =str_replace("\\","",$string); $string =str_replace("UNION","",$string); $banlist = array(" insert", " INSERT", " select", " SELECT", " update", " UPDATE", " delete", " DELETE", " distinct", " DISTINCT", " having", " HAVING", " truncate", " TRUNCATE", " replace"," REPLACE", " drop", " DROP", " handler", " like", " procedure", " limit ", "order by", "group by", "'", "union all", "=", "'", "<", ">", "-shutdown",  "--", "'", "ï¿½", "'or'1'='1'", "--",  "xp_", " and"); $string = trim(str_replace($banlist, ' ', $string)); return $string; }

    public static function protectPass($string) { return self::protect($string); }

    public static function protectText($sql) { $sql = trim($sql); $sql = addslashes($sql);  return $sql; }

    public static function protectArray($array) {$array_keys = array_keys($array); $SizeArray = sizeof($array_keys); $NewArray = array(); for($i=0; $i<$SizeArray; $i++) { $valor = self::protect(utf8_decode(rawurldecode($array[$array_keys[$i]]))); $NewArray[$array_keys[$i]] = $valor; } return($NewArray); }

    public static function postAjax($string) { return(utf8_decode(rawurldecode($string))); }

    public static function postAjaxArray($array) { $array_keys = array_keys($array); $SizeArray = sizeof($array_keys); $NewArray = array(); for($i=0; $i<$SizeArray; $i++) { if(is_array($array[$array_keys[$i]])) { self::postAjaxArray($array[$array_keys[$i]]); } else { $valor = (($array[$array_keys[$i]])); $NewArray[$array_keys[$i]] = $valor; } } return($NewArray); }

    public static function br2nl($string) { return str_replace( ['<br>', '<br />', '<br> ', '<br /> '], "\n", $string); }

    public static function nl2br($string) { return nl2br($string); }

    public static function replaceReturn($string) { return str_replace(array("\n\r", "\n", "\r"), '', $string); }

    /**************************************************************
    *
    * FUNÇÕES DE TRATAMENTO DE TEXTOS
    *
    **************************************************************/

    public static function toUpper($texto) { $texto = strtoupper($texto); $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"); $array2 = array("Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç"); return str_replace( $array1, $array2, $texto ); }

    public static function toLower($texto) { $texto = strtolower($texto); $array1 = array("Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç"); $array2 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"); return str_replace( $array1, $array2, $texto ); }

    public static function toBusca($texto) { return(self::removeChars($texto)); }

    public static function removeChars( $texto ) { $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" , "'", '"', "!", "@", "#", "$", "%", "¨", "&", "*", "(", ")", "-", "=", "+", "´", "`", "[", "]", "{", "}", "~", "^", ",", "<", ".", ">", ";", ":", "/", "?", "\\", "|", "¹", "²", "³", "£", "¢", "¬", "§", "ª", "º", "°", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ); $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" , "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ); return str_replace( $array1, $array2, $texto ); }

    public static function removeAcentos( $texto ) { $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ); $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ); return str_replace( $array1, $array2, $texto ); }

    public static function prepareLog( $log, $type, $limit = 50 ) {

        $rows = explode('<br />', $log);

        $new_log = [];
        $text_log = [];

        if(sizeof($rows) > 0) {

            $count = 0;

            foreach($rows as $row) {

                $new_log[] = $row;

                if($count < $limit) {
                    $text_log[] = $row;
                }

                $count++;

            }

        }

        $finalLog = [ 1 => implode('<br>', $new_log), 2 => implode('<br>', $text_log) ];

        return ($type == 'P') ? '<strong>Últimas 50 ações</strong>'. $finalLog[1] : $finalLog[2];

    }

    public static function logEntry($desc) {

        return '['. date('d/m/Y H:i') .'h] - ' . $desc .'<br>';

    }

 /**************************************************************
    *
    * FUNÇÕES DE TRATAMENTO DE URL
    *
    **************************************************************/

    public static function removeCharsUrl( $texto ) { $array1 = array("á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç" , "'", '"', "!", "@", "#", "$", "%", "¨", "&", "*", "(", ")", "=", "+", "´", "`", "[", "]", "{", "}", "~", "^", ",", "-", "<", ".", ">", ";", ":", "/", "?", "\\", "|", "¹", "²", "³", "£", "¢", "¬", "§", "ª", "º", "°", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" ); $array2 = array("a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c" , " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" ); return str_replace( $array1, $array2, $texto ); }

    private static function rebuildUrl($URL) { $NOVA_URL = ''; $Q = explode(" ", $URL); $SIZE = sizeof($Q); for($i=0; $i<$SIZE; $i++) { if($Q[$i] != '') { $NOVA_URL .= ($i > 0 && $NOVA_URL != '') ? ' ' : '';  $NOVA_URL .= $Q[$i]; } } return($NOVA_URL); }

    public static function parseUrl($texto) { $texto = self::removeCharsUrl($texto); $texto = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($texto)); $texto = self::rebuildUrl($texto); $texto = strtolower($texto); $texto = str_replace(" ", "-", $texto); return($texto); }

    public static function URI($REQ) { $URL = self::cleanArray(explode("/",$REQ)); return($URL); }

    public static function retornaKey($POS, $ARRAY) { if(!in_array($POS, $ARRAY)) {  return "0"; } else { $KEYS = array_keys($ARRAY); $SIZE_KEYS = sizeof($KEYS); for($i = 0;$i < $SIZE_KEYS; $i++) { if($ARRAY[$KEYS[$i]] == $POS) { break; } else { next($ARRAY); } } return key($ARRAY); } }

    /******************************************
    *
    * FUNCTION VERIFICAR URL
    *
    ******************************************/
    public static function verifyURL( $FUNC, $TABLE, $ID, $URL) { global $DB; $QUERY_ID = ($FUNC == 'EDIT') ? " AND MD5(id) <> '". $ID ."' " : ''; $SELECT = $DB->query("SELECT id FROM ". $TABLE ." WHERE url = '". $URL ."' ". $QUERY_ID ." LIMIT 1"); return ($SELECT->rowCount() == 1) ? false : true; }

    /******************************************
    *
    * FUNCTION VERIFICAR E-MAIL
    *
    ******************************************/

    public static function verifyEmail($FUNC, $TABLE, $EMAIL, $ID = 0) { global $DB; $QUERY = ''; if($FUNC == "EDIT") { $QUERY = " AND MD5(id) <> '". $ID ."'"; } $SELECT = $DB->query("SELECT id FROM ". $TABLE ." WHERE email = '". $EMAIL ."' ". $QUERY ." LIMIT 1"); return $SELECT->rowCount(); }

    /******************************************
    *
    * FUNCTION VERIFICAR DOCUMENT
    *
    ******************************************/

    public static function verifyDocument($FUNC, $TABLE, $DOC, $ID = 0) { global $DB; $QUERY = ''; if($FUNC == "EDIT") { $QUERY = " AND MD5(id) <> '". $ID ."'"; } $SELECT = $DB->query("SELECT id FROM ". $TABLE ." WHERE document = '". $DOC ."' ". $QUERY ." LIMIT 1"); return $SELECT->rowCount(); }

    /**************************************************************
    *
    * FUNÇÕES DE STRINGS E CONTEÚDO
    *
    **************************************************************/

    public static function money($VAL, $ADDRS = true, $ZERO = false) { if($VAL > 0) { $VALOR = (($ADDRS) ? 'R$ ' : '' ) . number_format($VAL, 2, ",", "."); } else { $VALOR = ''; } return($VALOR);  }

    public static function moneySQL($VAL) { if($VAL != '') { $source = array('.', ','); $replace = array('', '.'); $VAL = str_replace($source, $replace, $VAL); return(number_format(str_replace('R$ ', '', $VAL), 2, ".", "")); } }

    public static function percent($VAL) { return ($VAL * 1).'%'; }

    public static function percentSQL($VAL = 0) { return str_replace(',', '.', $VAL); }

    public static function linkBack() { return('<a rel="nofollow" class="link-back"><span class="icon icon-chevron-left"></span>voltar</a>'); }

    public static function stringSearch($TXT) { return(self::protect(self::removeChars($TXT))); }

    public static function stringSearchRegexp($str) { $str = trim(strtolower($str)); while ( strpos($str,"  ") ) {	$str = str_replace("  "," ",$str); }$caracteresPerigosos = array ("Ã","ã","Õ","õ","á","Á","é","É","í","Í","ó","Ó","ú","Ú","ç","Ç","à","À","è","È","ì","Ì","ò","Ò","ù","Ù","ä","Ä","ë","Ë","ï","Ï","ö","Ö","ü","Ü","Â","Ê","Î","Ô","Û","â","ê","î","ô","û","!","?",",","","","-","\"","\\","/"); $caracteresLimpos    = array ("a","a","o","o","a","a","e","e","i","i","o","o","u","u","c","c","a","a","e","e","i","i","o","o","u","u","a","a","e","e","i","i","o","o","u","u","A","E","I","O","U","a","e","i","o","u",".",".",".",".",".",".","." ,"." ,".");	$str = str_replace($caracteresPerigosos,$caracteresLimpos,$str);$caractresSimples = array("a","e","i","o","u","c");	$caractresEnvelopados = array("[a]","[e]","[i]","[o]","[u]","[c]"); $str = str_replace($caractresSimples,$caractresEnvelopados,$str);	$caracteresParaRegExp = array("(a|ã|á|à|ä|â|&atilde;|&aacute;|&agrave;|&auml;|&acirc;|Ã|Á|À|Ä|Â|&Atilde;|&Aacute;|&Agrave;|&Auml;|&Acirc;)", "(e|é|è|ë|ê|&eacute;|&egrave;|&euml;|&ecirc;|É|È|Ë|Ê|&Eacute;|&Egrave;|&Euml;|&Ecirc;)", "(i|í|ì|ï|î|&iacute;|&igrave;|&iuml;|&icirc;|Í|Ì|Ï|Î|&Iacute;|&Igrave;|&Iuml;|&Icirc;)", "(o|õ|ó|ò|ö|ô|&otilde;|&oacute;|&ograve;|&ouml;|&ocirc;|Õ|Ó|Ò|Ö|Ô|&Otilde;|&Oacute;|&Ograve;|&Ouml;|&Ocirc;)","(u|ú|ù|ü|û|&uacute;|&ugrave;|&uuml;|&ucirc;|Ú|Ù|Ü|Û|&Uacute;|&Ugrave;|&Uuml;|&Ucirc;)", "(c|ç|Ç|&ccedil;|&Ccedil;)" ); $str = str_replace($caractresEnvelopados,$caracteresParaRegExp,$str); $str = str_replace(" ",".*",$str); return $str; }

    public static function reduce($Texto, $Final, $Limite) {  if(strlen($Texto) > $Limite) {  $ultimo_espaco = strrpos(substr($Texto, 0, $Limite), ' '); $Temp = trim(substr($Texto, 0, $ultimo_espaco)).$Final; }  else  {  $Temp = $Texto;  }  return($Temp);  }

    public static function removeZeros($ARRAY) { $Q = explode(",", $ARRAY); $SIZE = sizeof($Q); for($i=0; $i<$SIZE; $i++) { if($Q[$i] != '0') { $NOVA_ARRAY .= ($i > 0 && $NOVA_ARRAY > 0) ? ',' : '';  $NOVA_ARRAY .= $Q[$i]; } } return($NOVA_ARRAY); }

    public static function prepareFulltext($KEYWORDS) {

        $query = '';
        $words = explode(" ", self::removeChars($KEYWORDS));

        foreach($words AS $word) {

            $query .= (($query !== '') ? ' ' : '') . $word .'*';

        }

        return $query;
    }

    public static function evenOdd ($number) {

        if($number % 2 == 0){
            return "even";
        }
        else {
            return "odd";
        }

    }

    public static function paragraphs( $text ) {
        $paragraphs = [];

        $split = explode('</p>', $text);

        foreach($split as $paragraph) {
            if(strlen(trim($paragraph)) > 3)
            {
                $paragraphs[] = $paragraph . '</p>';
            }
        }

        return $paragraphs;
    }

    /**************************************************************
    *
    * FUNÇÕES ARRAY
    *
    **************************************************************/

    public static function orderArray($array, $by, $order, $type) { $sortby = "sort$by"; $firstval = current($array);  $vals = array_keys($firstval); foreach ($vals as $init) { $keyname = "sort$init"; $$keyname = array(); } foreach ($array as $key => $row)  { foreach ($vals as $names){ $keyname = "sort$names"; $test = array(); $test[$key] = $row[$names]; $$keyname = array_merge($$keyname,$test); } } if ($order == "DESC") { if ($type == "NUM") { array_multisort($$sortby,SORT_DESC, SORT_NUMERIC,$array); } else  { array_multisort($$sortby,SORT_DESC, SORT_STRING,$array); } }  else  {  if ($type == "NUM") { array_multisort($$sortby,SORT_ASC, SORT_NUMERIC,$array); }  else  { array_multisort($$sortby,SORT_ASC, SORT_STRING,$array); } } return $array; }

    public static function cleanArray($Array) {
        $SizeArray = sizeof($Array);

        for($i=0; $i<$SizeArray; $i++)
        {
            if(isset($Array[$i]) && ((trim(strip_tags($Array[$i])) == "") || (trim(strip_tags($Array[$i])) == "#")))
            {
                for($x=$i; $x<$SizeArray; $x++)
                {
                    if(isset($Array[$x+1]))
                    {
                        $Array[$x] = self::protect(trim(strip_tags($Array[$x+1])));
                    }
                }
            }
        }

        for($i=$SizeArray; $i>0; $i--)
        {
            if(isset($Array[$i]))
            {
                if(trim(strip_tags($Array[$i])) == "") { unset($Array[$i]); }
            }
        }

        return($Array);
    }

    public static function arrayPush($INC, $TOTAL) { $array = array(); $y = $INC; for($i=$INC; $i<($TOTAL+$INC); $i++) { array_push($array, $y); $y += $INC; } 	return($array); }

    public static function xmlArray($xml) { $xml = simplexml_load_string($xml); $iter = 0; foreach($xml->children() as $b) { $a = $b->getName(); if(!$b->children()) { $arr[$a] = utf8_decode(trim($b[0])); } else { $arr[$a][$iter] = array(); $arr[$a][$iter] = self::xml2array($b,$arr[$a][$iter]); } $iter++; } return $arr; }

    public static function quakeArray($array) { if (is_array($array)) { $keys = array_keys($array); $temp = $array; $array = NULL; shuffle($temp); foreach ($temp as $k => $item) { $array[$keys[$k]] = $item; } return ($array); } return false; }

    public static function UF() { $ArrayEstados = array("AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO",  "RR", "SC", "SE", "SP", "TO"); return($ArrayEstados); }

    public static function array_icount_values($array) { $ret_array = array(); foreach($array as $value) { foreach($ret_array as $key2 => $value2) { if(strtolower($key2) == strtolower($value)) { $ret_array[$key2]++; continue 2; } } $ret_array[$value] = 1; } return $ret_array; }

    /**************************************************************
    *
    * FUNÇÕES DE VALIDAÇÃO E MASCARAS
    *
    **************************************************************/

    public static function validateEmail($email) { if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email)) { return true; } else { return false; } }

    public static function validateCPF($cpf) {
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        if (strlen($cpf) != 11) { return false; }
        if (preg_match('/(\d)\1{10}/', $cpf)) { return false; }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) { $d += $cpf[$c] * (($t + 1) - $c); }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) { return false; }
        }
        return true;
    }

    public static function validateCNPJ($cnpj = null) {

        if(empty($cnpj)) {

            return false;

        }

        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

        $repeticoes = array('00000000000000','11111111111111','22222222222222','33333333333333','44444444444444','55555555555555','66666666666666','77777777777777','88888888888888','99999999999999');

        // Verifica se nenhuma das sequências invalidas abaixo foi digitada. Caso afirmativo, retorna falso

        if (in_array($cnpj, $repeticoes)) {

            return false;

        } else {

            // Calcula os digitos verificadores para verificar se o CNPJ é válido

            $j = 5;
            $k = 6;
            $soma1 = "";
            $soma2 = "";

            for ($i = 0; $i < 13; $i++) {

                $j = $j == 1 ? 9 : $j;

                $k = $k == 1 ? 9 : $k;

                $soma2 += ($cnpj[$i] * $k);

                if ($i < 12) {

                    $soma1 += ($cnpj[$i] * $j);

                }

                $k--;
                $j--;

            }

            $digito1 = ($soma1 % 11 < 2) ? 0 : (11 - $soma1 % 11);

            $digito2 = ($soma2 % 11 < 2) ? 0 : (11 - $soma2 % 11);

            return (($cnpj[12] == $digito1) and ($cnpj[13] == $digito2));

        }

    }

    public static function normalizeName($string) { $word_splitters = array(' ', '-', "O'", "L'", "D'", 'St.', 'Mc');	$lowercase_exceptions = array('de', 'da', 'des', 'das', 'e', "l'", "d'"); $uppercase_exceptions = array('III', 'IV', 'VI', 'VII', 'VIII', 'IX'); $string = strtolower($string); foreach ($word_splitters as $delimiter) { $words = explode($delimiter, $string); $newwords = array(); foreach ($words as $word) { if (in_array(strtoupper($word), $uppercase_exceptions)) { $word = strtoupper($word); } else { if (!in_array($word, $lowercase_exceptions)) { $word = ucfirst($word); } } $newwords[] = $word; } if (in_array(strtolower($delimiter), $lowercase_exceptions)) { $delimiter = strtolower($delimiter); } $string = join($delimiter, $newwords); } return $string; }

    private function applyMask($mascara,$string) { $string = str_replace(" ","",$string);  for($i=0;$i<strlen($string);$i++) { $mascara[strpos($mascara,"#")] = $string[$i]; } return $mascara; }

    public static function phoneMask($NUM) { if(strlen($NUM) == 10) { $NUM = self::applyMask('(##) ####-####', $NUM); } else if(strlen($NUM) == 11) { $NUM = self::applyMask('(##) #####-####', $NUM); } return($NUM); }

    public static function cepMask($string) { $CEP = substr($string, 0, 2) . '.' . substr($string, 2, 3) . '-' . substr($string, 5, 3); return($CEP); }

    /**************************************************************
    *
    * FUNÇÕES ENCODE / DECODE
    *
    **************************************************************/

    public static function encode(string $str) { return base64_encode($str); }

    public static function decode(string $str) { return base64_decode($str); }

    public static function encodeText($TEXT) { return htmlentities(preg_replace('/\s/',' ', trim($TEXT)), ENT_QUOTES, 'UTF-8'); }

    public static function decodeText($TEXT) { return preg_replace('/\s/',' ', html_entity_decode($TEXT, ENT_QUOTES, 'UTF-8')); }

    public static function addFullText($TEXT) { $TEXT = str_replace('<p></p>', '', $TEXT); $TEXT = str_replace('+', '{{plus}}', $TEXT); $TEXT = addslashes($TEXT); $TEXT = self::minifyHtml(preg_replace('/[\pZ\pC]/u',' ', $TEXT)); return self::escape_mimic(preg_replace('/\s/',' ',trim($TEXT))); }

    public static function getFullText($TEXT) { $TEXT = stripslashes($TEXT); $TEXT = str_replace(["\'", '\"', "{{plus}}",], ["'", '"', "+"], $TEXT); return preg_replace('/\s/',' ', $TEXT); }

    public static function minifyHtml( $string ) {
        return preg_replace('#(?ix)(?>[^\S ]\s*|\s{2,})(?=(?:(?:[^<]++|<(?!/?(?:textarea|pre)\b))*+)(?:<(?>textarea|pre)\b|\z))#', ' ', $string);
    }

    public static function escape_mimic($inp) {

        if(is_array($inp))
            return array_map(__METHOD__, $inp);

        if(!empty($inp) && is_string($inp)) {
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
        }

        return $inp;

    }

    /**************************************************************
    *
    * FUNÇÕES DATA
    *
    **************************************************************/

    public static function date($date) { if($date != '' && strlen($date) == 10 && $date != '0000-00-00') { $q = explode("-", $date); return($q[2]."/".$q[1]."/".$q[0]); } }

    public static function dateMini($date) { $q = explode("-", $date); return($q[2]."/".$q[1]); }

    public static function dateSQL($date = '') { if($date != '') { $q = explode("/", $date); if(sizeof($q) == 3) { return($q[2]."-".$q[1]."-".$q[0]); } else { return ''; } } else { return ''; } }

    public static function day($date) { $date_ = explode("-", $date);  $TIME = mktime(0,0,0, $date_[1], $date_[2], $date_[0]); $day = date("w", $TIME); return($day); }

    public static function getDay($cod) { $day = array(0 => "Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"); return($day[$cod]); }

    public static function getDayMini($cod) { $day = array(0 => "Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"); return($day[$cod]); }

    public static function getDayLetter($cod) { $day = array(0 => "D", "S", "T", "Q", "Q", "S", "S"); return($day[$cod]); }

    public static function months($cod = '') { if($cod == 0) { $cod = date("m"); } $months = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"); return($cod != '') ? $months[$cod] : $months; }

    public static function monthRed($cod) { if(($cod == "") || ($cod == 0)) { $cod = date("m"); } $months = array(1 => "JAN", "FEV", "MAR", "ABR", "MAI", "JUN", "JUL", "AGO", "SET", "OUT", "NOV", "DEZ"); return($months[$cod]); }

    public static function dateExtends($date) { if($date != '0000-00-00') { $day = self::day($date); $day = self::getDay($day); $Q = explode("-", $date); $month = self::months(intval($Q[1])); return($day.", ".$Q[2]." de ". $month ." de ".$Q[0]); } else { return '-'; } }

    public static function hour($hour, $add = true) { if($hour != '') { return(substr($hour, 0, 5) . (($add) ? 'h' : '')); } else { return '00:00'; } }

    public static function dataToTimestamp($date) { $year = substr($date, 6,4); $month = substr($date, 3,2); $day = substr($date, 0,2); return mktime(0, 0, 0, $month, $day, $year); }

    public static function sumDay($date, $num = 1){ $year = substr($date, 6,4); $month = substr($date, 3,2); $day = substr($date, 0,2); return date("d/m/Y", mktime(0, 0, 0, $month, $day+$num, $year)); }

    public static function holidays($year,$pos) { $day = 86400; $dates = array(); $dates['pascoa'] = easter_date($year); $dates['sexta_santa'] = $dates['pascoa'] - (2 * $day); $dates['carnaval'] = $dates['pascoa'] - (47 * $day); $dates['corpus_cristi'] = $dates['pascoa'] + (60 * $day); $holidays = array ('01/01', '02/02', date('d/m',$dates['carnaval']), date('d/m',$dates['sexta_santa']), date('d/m',$dates['pascoa']), '21/04', '01/05', date('d/m',$dates['corpus_cristi']), '20/09', '12/10', '02/11', '15/11', '25/12'); return $holidays[$pos]."/".$year; }

    public static function sumUtilDays($initialDate, $days) { for($i=1; $i<=$days; $i++) { $initialDate=sumDay($initialDate);  if(date("w", dataToTimestamp($initialDate))=="0") { $initialDate=sumDay($initialDate); } else if(date("w", dataToTimestamp($initialDate))=="6"){ $initialDate=sumDay($initialDate); $initialDate=sumDay($initialDate); } else { for($i=0; $i<=12; $i++) { if($initialDate==holidays(date("Y"),$i)) { $initialDate=sumDay($initialDate); } } } } return $initialDate; }

    public static function dateAndTime($date, $time) { $return = '-'; if(isset($date) && $date != NULL) { $return = self::date($date); if(isset($time) && $time != NULL) { $return .= ' às '. self::hour($time); } } return $return; }

    public static function datetime($date, $type = 'array', $sep = ' - ') {

        if($type == 'array')
        {
            $PARTS = explode(' ', $date);
            $DATE = array(
                0 => self::date($PARTS[0]),
                self::hour($PARTS[1])
            );
        }
        else
        {
            $PARTS = explode(' ', $date);
            $DATE = (isset($PARTS[0]) && isset($PARTS[1])) ? (($PARTS[0] != '0000-00-00') ? self::date($PARTS[0]) : '') . (($PARTS[1] != '00:00:00') ? $sep . self::hour($PARTS[1]) : '') : '-';
        }

        return $DATE;
    }

    public static function dateSum($DATE, $DAYS){
        $datetime = new \DateTime($DATE);
        $datetime->modify($DAYS);
        return $datetime->format('Y-m-d');
    }

    public static function daysBetween( $DATE_1, $DATE_2 ) {

        $timestamp1 = strtotime($DATE_1);
        $timestamp2 = strtotime($DATE_2);

        $MINUTES = round(abs($timestamp2 - $timestamp1)/60);
        $HOURS = round(abs($timestamp2 - $timestamp1)/(60*60));
        $DAYS = round($HOURS / 24);

        if($HOURS >= 24) {

            $RETURN = $DAYS . (($DAYS > 1) ? ' dias' : ' dia');

        }
        else  {

            if($HOURS >= 1) {

                $RETURN = $HOURS .' hora'. (($HOURS > 1) ? 's' : '');

            }
            else {

                $RETURN = (($MINUTES > 0) ? $MINUTES : 'menos de 1') .' minuto'. (($MINUTES > 1) ? 's' : '');

            }

        }

        return $RETURN;

    }

    public static function hoursBetween( $DATE_1, $DATE_2 ) {
        $timestamp1 = strtotime($DATE_1);
        $timestamp2 = strtotime($DATE_2);

        $MINUTES = round(abs($timestamp2 - $timestamp1)/60);
        $HOURS = round(abs($timestamp2 - $timestamp1)/(60*60));

        if($HOURS >= 24)
        {
            $DAYS = round($HOURS / 24);

            if($HOURS < 48)
            {
                $RETURN = 'Ontem';
            }
            else if($HOURS < 72)
            {
                $RETURN = 'Anteontem';
            }
            else
            {
                if($DAYS > 30)
                {
                    $MONTHS = floor($DAYS / 30);
                    $MONTHS_COMPARE = round($DAYS / 30);

                    $RETURN = 'Há '. (($MONTHS_COMPARE > $MONTHS) ? 'mais de ' : '') . $MONTHS .' '. (($MONTHS > 1) ? 'meses' : 'mês');

                }
                else if($DAYS > 6)
                {
                    $WEEKS = round($DAYS / 7);
                    $RETURN = 'Há '. $WEEKS .' semana'. (($WEEKS > 1) ? 's' : '');
                }
                else
                {
                    $RETURN = 'Há '. $DAYS .' dia'. (($DAYS > 1) ? 's' : '');
                }
            }
        }
        else
        {
            if($HOURS >= 1)
            {
                $RETURN = 'Há '. $HOURS .' hora'. (($HOURS > 1) ? 's' : '');
            }
            else
            {
                $RETURN = 'Há '. (($MINUTES > 0) ? $MINUTES : 'menos de 1') .' minuto'. (($MINUTES > 1) ? 's' : '');
            }
        }

        return $RETURN;
    }

    public static function validateDate($date, $format = 'Y-m-d H:i:s') {

        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;

    }

    public static function pagination($TOTAL, $LIMIT) {
        $PAGINATION = array();

        $PAGINATION['pages'] = ceil($TOTAL/ $LIMIT);

        if(!isset($_GET['pg'])) {
            $PAGINATION['pg'] = 0;
            $PAGINATION['pg2'] = 1;
        } else {
            $PAGINATION['pg'] = $_GET['pg']-1;
            $PAGINATION['pg2'] = $_GET['pg'];
        }

        $PAGINATION['init'] = $PAGINATION['pg'] * $LIMIT;

        return $PAGINATION;
    }

    /**************************************************************
    *
    * IP REAL
    *
    **************************************************************/

    public static function IP() { return($_SERVER['REMOTE_ADDR']); }

    /**************************************************************
    *
    * DATABASE
    *
    **************************************************************/

    public static function uniqueID($TABLE, $SIZE = 12, $SEP = true, $PRE = '') {

        global $DB;

        $chars = self::quakeArray(array(0=> 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'E', 'K', 'D', 'Q', 'P', 'Y', 'S', 'X', 'B', 'N', 'W', 'M', 'T', 'Z', 'C', 'V', 'F', 'G', 'H', 'J', 'R', 'L'));
        $size_chars = sizeof($chars) - 1;

        $id_temp = $PRE;

        for($i=0; $i<($SIZE+1); $i++)
        {
            if($i != intval($SIZE/2) || !$SEP)
            {
                $id_temp .= $chars[rand(0,$size_chars)];
            }
            else {
                $id_temp .= '-';
            }
        }


        $SELECT_UNICO = $DB->query("SELECT id FROM ". $TABLE . " WHERE unique_id = '". $id_temp ."' LIMIT 1");
        if($SELECT_UNICO->rowCount() == 0)
        {
            return($id_temp);
        }
        else {
            self::uniqueID();
        }

    }

    public static function nextOrder($TABLE, $WHERE = '') {

        global $DB;

        $SELECT = $DB->query(" SELECT _order FROM {$TABLE} {$WHERE} ORDER BY _order DESC LIMIT 1 ");
        $TOTAL = $SELECT->rowCount();
        if($TOTAL > 0)
        {
            $ROW = $DB->fetch($SELECT);
            $RESULT = $ROW['_order'] + 1;

            return $RESULT;
        }
        else {

            return 1;

        }

    }

    public static function getInfoBy($TABLE, $WHERE, $FIELD = "*") {

        global $DB;

        $SELECT = $DB->select($TABLE, $FIELD, $WHERE . " LIMIT 1");
        $TOTAL = $SELECT->rowCount();
        if($TOTAL > 0)
        {
            $RESULT = $SELECT->fetch();
            return $RESULT;
        }
        else
        {
            return array("N/E");
        }

    }

    public static function getInfo($TABLE, $ID, $FIELD = "*") {
        global $DB;

        $SELECT = $DB->select($TABLE, $FIELD, "id = '{$ID}' LIMIT 1");
        $TOTAL = $SELECT->rowCount();
        if($TOTAL > 0)
        {
            $RESULT = $SELECT->fetch();
            return $RESULT;
        }
        else
        {
            return array("N/E");
        }
    }

    public static function getInfoEnc($TABLE, $ID, $FIELD = "*") {
        global $DB;

        $SELECT = $DB->select($TABLE, $FIELD, "MD5(id) = '{$ID}' LIMIT 1");
        $TOTAL = $SELECT->rowCount();
        if($TOTAL > 0)
        {
            $RESULT = $SELECT->fetch();
            return $RESULT;
        }
        else
        {
            return array("N/E");
        }
    }

    public static function getInfoUrl($TABLE, $URL, $FIELD = "*") {
        global $DB;

         $SELECT = $DB->select($TABLE, $FIELD, "url= '{$URL}' LIMIT 1");
         $TOTAL = $SELECT->rowCount();
         if($TOTAL > 0)
         {
             $RESULT = $SELECT->fetch();
             return $RESULT;
         }
         else
         {
             return array("N/E");
         }
    }

    public static function getText($ALIAS) {

        global $DB;

         $SELECT = $DB->select('text', 'content', "alias= '{$ALIAS}' LIMIT 1");
         $TOTAL = $SELECT->rowCount();
         if($TOTAL > 0)
         {
             $RESULT = $SELECT->fetch();
             return Main::getFullText($RESULT['content']);
         }
         else
         {
             return '[Não Encontrado]';
         }

    }


    /**
     * config
     *
     * @param  mixed $CAMPOS
     * @return void
     */
    public static function settings($CAMPOS = '*') {

        global $DB;

        $SELECT = $DB->select("settings", $CAMPOS, " id = 1 ");
        $TOTAL = $SELECT->rowCount();
        if($TOTAL > 0)
        {
            $ROW = $SELECT->fetch();
            return($ROW);
        }
        else
        {
            return(array());
        }

    }


    /**
     * emailSettings
     *
     * @return void
     */
    public static function emailSettings() {
        global $DB;

        $SELECT = $DB->select("settings_email", "*", " id = 1 AND status = 1 ");
        $TOTAL = $SELECT->rowCount();
        if($TOTAL > 0)
        {
            return($SELECT->fetch());
        }
        else {
            return array(
                'smtp_server' => '',
                'smtp_user' => '',
                'smtp_password' => ''
            );
        }
    }


    /**
     * socialMediaSettings
     *
     * @return void
     */
    public static function socialMediaSettings() {

        global $DB;

        try {

            $SELECT = $DB->query("SELECT * FROM social_media WHERE id = '1' ");
            $TOTAL = $SELECT->rowCount();
            if($TOTAL > 0)
            {

                return $SELECT->fetch();

            }
            else {

                return [
                    'facebook' => '',
                    'twitter' => '',
                    'instagram' => '',
                    'linkedin' => '',
                    'pinterest' => '',
                    'youtube' => ''
                ];

            }

        } catch(\Exception $e) {

            return [
                'facebook' => '',
                'twitter' => '',
                'instagram' => '',
                'linkedin' => '',
                'pinterest' => '',
                'youtube' => ''
            ];

        }

    }


    /**
     * configWebPushr
     *
     * @return void
     */
    public static function configWebPushr() {
        global $DB;

        $SELECT = $DB->select("settings_webpushr", "*", " id = 1 ");
        $TOTAL = $SELECT->rowCount();
        if($TOTAL > 0)
        {
            $ROW = $SELECT->fetch();

            foreach($ROW AS $key => $value) {
                $ROW[$key] = self::decodeText($value);
            }

            return($ROW);
        }
        else {
            return array(
                'api_url' => '',
                'api_key' => '',
                'api_token' => ''
            );
        }
    }


    /**
     * newsletterSettings
     *
     * @return void
     */
    public static function newsletterSettings() {

        global $DB;

        $SELECT = $DB->select("newsletter_settings", "*", " id = 1 ");
        $TOTAL = $SELECT->rowCount();
        if($TOTAL > 0)
        {
            return $SELECT->fetch();
        }
        else {
            return [];
        }

    }


    /**************************************************************
    *
    * FUNÇÕES DE ARQUIVOS
    *
    **************************************************************/

    public static function createDir($DIR) { mkdir($DIR, 0775); }

    public static function modDir($DIR, $EDIT) { if($EDIT) { chmod($DIR, 0777); } else { chmod($DIR, 0775); } }

    public static function extension($TXT) { $INFO = array_reverse(explode('.', $TXT)); $EXT = strtolower($INFO[0]); return($EXT); }

    public static function jsPack($codigoJS) { $codigo_pack = new Packer($codigoJS, 'Normal', true, false); $codigo_pack = $codigo_pack->pack(); return($codigo_pack);	}

    public static function mimeType($filename) { $mime_types = array('txt' => 'text/plain', 'htm' => 'text/html', 'html' => 'text/html', 'php' => 'text/html', 'css' => 'text/css', 'js' => 'application/javascript', 'json' => 'application/json', 'xml' => 'application/xml', 'swf' => 'application/x-shockwave-flash', 'flv' => 'video/x-flv', 'png' => 'image/png', 'jpe' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'jpg' => 'image/jpeg', 'gif' => 'image/gif', 'bmp' => 'image/bmp', 'ico' => 'image/vnd.microsoft.icon', 'tiff' => 'image/tiff', 'tif' => 'image/tiff', 'svg' => 'image/svg+xml', 'svgz' => 'image/svg+xml', 'zip' => 'application/zip', 'rar' => 'application/x-rar-compressed',  'exe' => 'application/x-msdownload', 'msi' => 'application/x-msdownload', 'cab' => 'application/vnd.ms-cab-compressed', 'mp3' => 'audio/mpeg', 'qt' => 'video/quicktime', 'mov' => 'video/quicktime', 'pdf' => 'application/pdf', 'psd' => 'image/vnd.adobe.photoshop', 'ai' => 'application/postscript', 'eps' => 'application/postscript', 'ps' => 'application/postscript', 'doc' => 'application/msword', 'docx' => 'application/msword', 'rtf' => 'application/rtf', 'xls' => 'application/vnd.ms-excel', 'xlsx' => 'application/vnd.ms-excel', 'ppt' => 'application/vnd.ms-powerpoint', 'pptx' => 'application/vnd.ms-powerpoint', 'odt' => 'application/vnd.oasis.opendocument.text', 'ods' => 'application/vnd.oasis.opendocument.spreadsheet'); $ext = strtolower(array_pop(explode('.',$filename))); if (array_key_exists($ext, $mime_types)) { return $mime_types[$ext]; } elseif (function_exists('finfo_open')) { $finfo = finfo_open(FILEINFO_MIME); $mimetype = finfo_file($finfo, $filename); finfo_close($finfo); return $mimetype; } else { return 'application/octet-stream'; } }

    public static function readFile ($PATH) { $fp = fopen($PATH, 'r'); $html = fread($fp,filesize($PATH)); fclose($fp); return($html); }

    public static function filesize($path) { $FILESIZE = (filesize($path)/1024); if($FILESIZE > 1024) { $FILESIZE = number_format(($FILESIZE/1024), 2, ',', '.') .' MB'; } else { $FILESIZE = number_format($FILESIZE, 2, ',', '.') . ' KB'; } return $FILESIZE; }

    public static function createZip( $path, $files ) {

        $zip = new \ZipArchive;
        $zip->open( $path, \ZipArchive::CREATE);

        if ( !empty( $files ) ) {
            foreach ( $files as $file ) {
                $zip->addFile( $file['path'], $file['name'] );
            }
        }

        $zip->close();

    }

    public static function testImage($file) {
        $size = filesize($file);

        if($size === false || !$img = @imagecreatefromstring(file_get_contents($file))) {
            return false;
        }

        return true;
    }

    public static function getYoutubeThumbnail( $videoId ) {

        $types = array ( 0 => 'maxresdefault', 'sddefault', 'hqdefault');

        foreach($types AS $type) {
            if(@fopen('https://img.youtube.com/vi/'. $videoId .'/'. $type .'.jpg', 'r'))
            {
                return $type;
                break;
            }
        }

        return '';
    }

    public static function getYoutubeCode($url) {

        $youtube_id = $url;

        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }

        return $youtube_id ;

    }

    public static function tinify($URL, $PATH, $FILENAME) {

        try {
            \Tinify\setKey("8t0GrVylMfsRmwfGng9SNn5KhWNvTTYk");
            \Tinify\validate();

            $compressionsThisMonth = \Tinify\compressionCount();

            if($compressionsThisMonth < 500) {

                try {
                    $tinify = \Tinify\fromUrl($URL . $FILENAME);

                    unlink($PATH.$FILENAME);

                    $tinify->toFile($PATH . $FILENAME);

                    unset($tinify);
                }
                catch(Exception $e) {
                    /* Something wrong with TinyPNG API, continue application */
                }

            }

        } catch(Tinify\Exception $e) {

        }

    }

    /**************************************************************
    *
    * OTHER FUNCTIONS
    *
    **************************************************************/

    public static function codeFormat($COD, $MAX = 5) { $Size = strlen($COD); $NovoCOD = $COD; if($Size < $MAX) { for($i=0; $i<($MAX-$Size); $i++) { $NovoCOD = 0 . $NovoCOD; } } return($NovoCOD); }

    public static function maskID($ID, $TYPE) { $ADD = 3952; if($TYPE) { $NEW_ID = $ID + $ADD; } else { $NEW_ID = $ID - $ADD; } return $NEW_ID; }

    public static function consultAddress($CEP) { $URL = 'https://viacep.com.br/ws/'.str_replace(array('.', '-'), array('', ''), $CEP).'/json'; $JSON = self::cURL($URL); return $JSON; }

    public static function cURL($URL, $POST = false, $JSON = false, $DATA = array(), $HEADERS = '') {
        $InitCURL = curl_init();
        curl_setopt($InitCURL, CURLOPT_URL, $URL);

        if($POST) {
            curl_setopt($InitCURL, CURLOPT_POST, 1);

            if($JSON) {
                curl_setopt($InitCURL, CURLOPT_POSTFIELDS, json_encode($DATA) );
            }
            else {
                curl_setopt($InitCURL, CURLOPT_POSTFIELDS, $DATA );
            }
        }

        if(is_array($HEADERS)) {
            curl_setopt($InitCURL, CURLOPT_HTTPHEADER, $HEADERS);
        }
        elseif($JSON) {
            curl_setopt($InitCURL, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "User-Agent: Mozilla/5.0 (Windows NT 6.3; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0"));
        }

        curl_setopt($InitCURL, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($InitCURL, CURLOPT_VERBOSE, true);
        curl_setopt($InitCURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($InitCURL, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($InitCURL, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($InitCURL, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($InitCURL, CURLOPT_STDERR, fopen(_ROOT .'curl.txt', 'w+'));
        $html = curl_exec($InitCURL);
        curl_close($InitCURL);

        return ($JSON) ? json_decode($html) : $html;
    }

    public static function imagePNG($arquivo, $PATH, $IMAGEM_FINAL, $largura, $altura, $FILTER = '') { $IMAGEM_COPIA = imagecreatefrompng($arquivo); $pontoX = @imagesx($IMAGEM_COPIA); $pontoY = @imagesy($IMAGEM_COPIA); $LARGURA = $largura; $ALTURA = $altura; $ESCALA = min(($LARGURA/$pontoX), ($ALTURA/$pontoY)); if($ESCALA < 1) { $N_LARGURA 	= floor($ESCALA*$pontoX); $N_ALTURA = floor($ESCALA*$pontoY); } else { $N_LARGURA 	= $pontoX; $N_ALTURA = $pontoY; } $IMAGEM_PARCIAL = imagecreatetruecolor($N_LARGURA, $N_ALTURA);	imagealphablending($IMAGEM_PARCIAL, false); imagesavealpha($IMAGEM_PARCIAL, true); $transparent = imagecolorallocatealpha($IMAGEM_PARCIAL, 255, 255, 255, 127); imagefilledrectangle($IMAGEM_PARCIAL, 0, 0, $N_LARGURA, $N_ALTURA, $transparent); if($FILTER != '')	{imagefilter($IMAGEM_COPIA, IMG_FILTER_GRAYSCALE); } @imagecopyresampled($IMAGEM_PARCIAL, $IMAGEM_COPIA, 0, 0, 0, 0, $N_LARGURA, $N_ALTURA, $pontoX, $pontoY); @imagepng($IMAGEM_PARCIAL, $PATH.$IMAGEM_FINAL, 9, PNG_ALL_FILTERS); @imagedestroy($IMAGEM_PARCIAL); }

    public static function newPassword($size = 8, $uppercase = true, $numbers = true, $symbols = false) { $lower = 'abcdefghijklmnopqrstuvwxyz'; $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; $num = '1234567890'; $symb = '!@#$%*-'; $newPassword = ''; $characters = ''; $characters .= $lower; if ($uppercase) $characters .= $upper; if ($numbers) $characters .= $num; if ($symbols) $characters .= $symb; $len = strlen($characters); for ($n = 1; $n <= $size; $n++) { $rand = mt_rand(1, $len); $newPassword .= $characters[$rand-1]; } return $newPassword; }

    public static function isXML($xml) {
        libxml_use_internal_errors(true);

        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML($xml);

        $errors = libxml_get_errors();

        if(empty($errors)){
             return true;
        }

        $error = $errors[0];
        if($error->level < 3){
             return true;
        }

        $explodedxml = explode("r", $xml);
        $badxml = $explodedxml[($error->line)-1];

        $message = $error->message . ' at line ' . $error->line . '. Bad XML: ' . htmlentities($badxml);
        return $message;
    }

    public static function share($text, $link, $push = '')
    {
        $links = '<a data-title="'. urlencode(self::decodeText($text)) .'" data-link="'. urlencode($link) .'" class="btn-facebook div-tooltip" data-toggle="tooltip" data-placement="top" title="Compartilhar no Facebook"><i class="icon icon-facebook-square"></i></a>';
        $links.= '<a data-title="'. utf8_encode(self::decodeText($text)) .'" data-link="'. $link .'" class="btn-twitter div-tooltip" data-toggle="tooltip" data-placement="top" title="Compartilhar no Twitter"><i class="icon icon-twitter"></i></a>';

        if(is_array($push))
        {
            $links.= '<a data-title="'. self::encodeText($push['title']) .'" data-text="'. self::encodeText($push['text']) .'" data-url="'. $push['url'] .'" class="btn-push div-tooltip" data-toggle="tooltip" data-placement="top" title="Enviar Push p/ Inscritos"><i class="icon icon-bell"></i></a>';
        }

        return $links;
    }

    /**************************************************************
    *
    * GET BROWSER
    *
    **************************************************************/

    public static function getBrowser() { $u_agent = $_SERVER['HTTP_USER_AGENT']; $bname = 'Desconhecido'; $platform = 'Desconhecido'; $version= ""; if (preg_match('/linux/i', $u_agent)) { $platform = 'Linux'; } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) { $platform = 'Mac'; } elseif (preg_match('/windows|win32/i', $u_agent)) { $platform = 'Windows'; } if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { $bname = 'Internet Explorer'; $ub = "MSIE"; } elseif(preg_match('/Firefox/i',$u_agent)) { $bname = 'Mozilla Firefox'; $ub = "Firefox"; } elseif(preg_match('/Chrome/i',$u_agent)) { $bname = 'Google Chrome'; $ub = "Chrome"; } elseif(preg_match('/Safari/i',$u_agent)){ $bname = 'Apple Safari'; $ub = "Safari"; } elseif(preg_match('/Opera/i',$u_agent)) { $bname = 'Opera'; $ub = "Opera"; }  elseif(preg_match('/Netscape/i',$u_agent)) { $bname = 'Netscape'; $ub = "Netscape"; } elseif(preg_match('/Thunderbird/i',$u_agent)) {  $bname = 'Mozilla Thunderbird'; $ub = "Thunderbird"; } elseif(preg_match('/Outlook/i',$u_agent)) { $bname = 'Outlook'; $ub = "Outlook"; } $known = array('Version', $ub, 'other'); $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#'; if (!preg_match_all($pattern, $u_agent, $matches)) { }  $i = count($matches['browser']);  if ($i != 1) { if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){ $version= $matches['version'][0]; } else { $version= $matches['version'][1]; }  } else { $version= $matches['version'][0]; }  if ($version==null || $version=="") {$version="?";}  return array( 'userAgent' => $u_agent, 'name' => $bname, 'version'   => $version, 'platform' => $platform, 'pattern' => $pattern ); }


    /**
     * prepareRoute
     *
     * @param  mixed $route
     * @return void
     */
    public static function prepareRoute($route) {

        $parts = explode('-', $route);

        $newRoute = '';

        foreach($parts as $part) {

           $newRoute .= ($newRoute === '') ? $part : ucfirst($part);

        }

        return $newRoute;
    }

}
