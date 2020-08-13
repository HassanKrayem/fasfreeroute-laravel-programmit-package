<?php

namespace Programmit\Traits\General;

trait Utility
{
    public function closeUserConnection($data = [])
    {
        ignore_user_abort(true);
        set_time_limit(0);
        // Sending header info to let the browser stop waiting for responce.
        ob_start();
        // do initial processing here
        echo $data; // send the response
        header('Connection: close');
        header('Content-Length: '.ob_get_length());
        ob_end_flush();
    }

    public function ajaxError($t, $s = 404)
    {
        return response()->json([
            'errors' => [$t],
        ]
        , $s); // Status code here
    }

    public function addStringToLimit($string, $limit, $padding = "0", $appendAfter = true)
    {
        $sCount = strlen($string);
        if ($sCount < $limit ) {
            $draft = '';
            $loops = $limit - $sCount;
            for ( $i = 0; $i < $loops; $i++) {
                $draft .= $padding;
            }

            if ($appendAfter) {
                return $draft . $string;    
            } else {
                return $string . $draft;
            }
            
        } else {
            return $string;
        }
    }

    public function utilCheckIfEmptyStrings($strArray)
    {
        foreach ($strArray as $str) {
            if (!empty($str)) {
                return false;
            }
        }
        return true;
    }
}