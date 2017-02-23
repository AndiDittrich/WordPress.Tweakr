<?php
/*  AUTO GENERATED FILE - DO NOT EDIT !!
    WP-SKELEKTON | MIT X11 License | https://github.com/AndiDittrich/WP-Skeleton
    ------------------------------------
    Hash Wrapper/Utility
*/
namespace Tweakr\skltn;

class Hash{

    const DEFAULT_ALGORITHM = 'sha256';

    // generate a length-limited hash with DEFAULT_ALGORITHM in hex format
    public static function hex($data, $length=null){
        // non string data ? use json encoding
        if (!is_string($data)){
            $data = json_encode($data);
        }

        // calculate hash
        $hash = hash(self::DEFAULT_ALGORITHM, $data);

        // limit length ?
        if ($length !== null){
            $hash = substr($hash, 0, $length);
        }

        return $hash;
    }

    // generate a length-limited hash with DEFAULT_ALGORITHM in base64 format
    public static function base64($data, $length=null){
        // non string data ? use json encoding
        if (!is_string($data)){
            $data = json_encode($data);
        }

        // calculate hash and use base64 encoding
        $hash = base64_encode(hash(self::DEFAULT_ALGORITHM, $data, true));

        // limit length ?
        if ($length !== null){
            $hash = substr($hash, 0, $length);
        }

        return $hash;
    }

    // generate a length-limited hash with DEFAULT_ALGORITHM in base64 format with url safe characters
    public static function filename($data, $length=null){
        // base64
        $hash = self::base64($data, $length);

        // url safe
        $hash = str_replace(array('+', '/', '='), array('-', '_', ''), $hash);

        return $hash;
    }
}