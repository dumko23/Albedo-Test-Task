<?php

namespace App\core;

class Controller extends Model
{
    public function registerNewMember($config, $data): bool|string
    {
        $result = $this->newMemberRecord($config, $data);
        if($result === true){
            return true;
        } else{
            return $result;
        }
    }

    public function updateAdditionalInfo($config, $data, $uploadFile, $basename): bool|array
    {
        $result = $this->updateMemberRecord($config, $data, $uploadFile, $basename);
        if(gettype($result) === 'object'){
            return true;
        } else{
            return $result;
        }
    }
}