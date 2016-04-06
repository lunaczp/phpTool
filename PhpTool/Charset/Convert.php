<?php
    namespace PhpTool\Charset;

    class Convert {

        public static function utf8_esc($code) {
            return preg_replace_callback(
                "@([0-9a-f]{2})@i",
                function($m){
                    return '\x' .$m[1];
                },
                bin2hex($code)
            );
        }

        public static function utf8_desc($code) {
            return preg_replace_callback(
                "@\\\x([0-9a-f]{2})@i",
                function($m){
                    return chr(hexdec($m[1]));
                },
                $code
            );
        }

        public static function unicode2utf8($code) {
            $reg1 ='/\\\u([0-9a-z]{2,5})/i';
            if (preg_match($reg1, $code)) {
                return preg_replace_callback($reg1, function($m){return self::do_unicode2utf8(hexdec($m[1]));}, $code);
            }

            $reg2 ="/&#(\d{2,6});/";
            if (preg_match($reg2, $code)) {
                return preg_replace_callback($reg2, function($m){return self::do_unicode2utf8($m[1]);}, $code);
            }

            return '';
        }

        public static function do_unicode2utf8($code) {
            $dec =$code;

            if ($dec < 128) {
                //1 byte
                $utf = chr($dec);
            } else if ($dec < 2048) {
                //2 byte
                $utf = chr(192 + (($dec - ($dec % 64)) / 64));
                $utf .= chr(128 + ($dec % 64));
            } else if($dec < 65536) {
                //3 byte
                $utf = chr(224 + (($dec - ($dec % 4096)) / 4096));
                $utf .= chr(128 + ((($dec % 4096) - ($dec % 64)) / 64));
                $utf .= chr(128 + ($dec % 64));
            } else {
                //4 byte
                $utf = chr(240 + (($dec - ($dec % 262144)) / 262144));
                $utf .= chr(128 + ((($dec % 262144) - ($dec % 4096)) / 4096));
                $utf .= chr(128 + ((($dec % 4096) - ($dec % 64)) / 64));
                $utf .= chr(128 + ($dec % 64));
            }
            return $utf;
        }

    }
