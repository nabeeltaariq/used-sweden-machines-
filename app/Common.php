<?php

namespace App;

class Common
{
    //
    public function SimplifiedPath($path){
        $pathToken = explode("/",$path);
        return $pathToken[count($pathToken)-1];
    }
}
