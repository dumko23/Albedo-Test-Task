<?php

namespace App;

class Controller extends Model
{
    public function registerNewMember($data): bool|string
    {
        $result = $this->newMemberRecord($data);
        if($result === true){
            return true;
        } else{
            return $result;
        }
    }

    public function updateAdditionalInfo($data, $uploadFile, $basename){
        $result = $this->updateMemberRecord($data, $uploadFile, $basename);
        if($result === true){
            return true;
        } else{
            return $result;
        }
    }
}