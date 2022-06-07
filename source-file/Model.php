<?php

namespace App;

class Model
{
    public array $errors = [];

    public function validate($record)
    {
        if ($record['firstName'] === '') {

        }
        if ($record['lastName'] === '') {

        }
        if ($record['date'] === '') {

        }
        if ($record['subject'] === '') {

        }
        if ($record['country'] === '') {

        }
        if ($record['phone'] !== '') {
            $record['phone'] = preg_replace('/\D/', '', $record['phone']);
            $number = explode('', $record['phone']);
            $number = "+" . $number[0] . " (" . implode('', array_splice($number, 1, 3)) . ") " . implode('', array_splice($number, 4, 3)) . "-" . implode('', array_splice($number, 7, 4));
            //"+1 (555) 555-5555"  /\+[0-9] \([0-9]{3}\) [0-9]{3}-[0-9]{4}/i
            if (preg_match('/\+\d \(\d{3}\) \d{3}-\d{4}/i', $number)) {
                $record['phone'] = $number;
            }
        }
        if ($record['email'] !== '' && filter_var($record['email'], FILTER_VALIDATE_EMAIL)) {
            PDOAdapter::db();
            if (isset(PDOAdapter::searchMember($record['email'])[0])) {

            }

        }
        return true;
    }

    public function newMemberRecord(array $post)
    {
        $data = $post;


        if ($this->validate($data)) {
            PDOAdapter::insertToDB($data['firstName'],
                $data['lastName'],
                $data['date'],
                $data['subject'],
                $data['country'],
                $data['phone'],
                $data['email']);
        }
    }

    public function update()
    {
    }


}