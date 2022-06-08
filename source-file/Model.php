<?php

namespace App;

class Model extends PDOAdapter
{

    public function validateInput($record): string
    {
        $errors = [];
        if ($record['firstName'] === '') {
            echo $record['firstName'];
            $errors['firstName'] = 'Input is empty!';
        }
        if ($record['lastName'] === '') {
            $errors['lastName'] = 'Input is empty!';
        }
        if ($record['date'] === '') {
            $errors['date'] = 'Input is empty!';
        }
        if ($record['subject'] === '') {
            $errors['subject'] = 'Input is empty!';
        }
        if (!isset($record['country'])) {
            $errors['country'] = 'Input is empty!';
        }
        if ($record['phone'] === '') {
            $errors['phone'] = 'Input is empty!';
        } else {
            $rowInput = $record['phone'];
            $number = preg_replace('/\D/', '', $record['phone']);
            if (strlen($number) === 11) {
                $number = str_split($number);
                $number = sprintf('+%s (%s) %s-%s',
                    $number[0],
                    implode('', array_splice($number, 0, 3)),
                    implode('', array_splice($number, 0, 3)),
                    implode('', array_splice($number, 0, 4))
                );
            }
            //"+1 (555) 555-5555"  /\+[0-9] \([0-9]{3}\) [0-9]{3}-[0-9]{4}/i
            if (preg_match('/\+\d \(\d{3}\) \d{3}-\d{4}/i', $number)) {
                $record['phone'] = $record;
            } else {
                $errors['phone'] = "Incorrect phone number format! Got: " . $rowInput . " Formated to : " . $number;
            }
        }

        if ($record['email'] === '') {
            echo $record['email'];
            $errors['email'] = 'Input is empty!';
        } else {
            if (filter_var($record['email'], FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Incorrect email format!';
            } else {
                self::connection();
                if (isset($this->searchMember($record['email'])[0])) {
                    $errors['email'] = 'This email is already registered!';
                }
            }
        }

        if (count($errors) === 0) {
            return true;
        } else {
            $result = json_encode($errors);
            unset($errors);
            return $result;
        }

    }

    public function newMemberRecord(array $post): bool|string
    {
        $data = $post;
        $validateResult = $this->validateInput($data);

        if (gettype($validateResult) !== "string") {
            self::insertMemberToDB($data['firstName'],
                $data['lastName'],
                $data['date'],
                $data['subject'],
                $data['country'],
                $data['phone'],
                $data['email']);
        } else {
            return $validateResult;
        }
        return true;
    }

    protected function insertMemberToDB(string $firstName, string $lastName, string $date, string $subject, string $country, string $phone, string $email): void
    {
        $this->connection()->prepare('insert into MemberList.Members 
    (firstName, lastName, date, subject, country, phone, email)
                                values (?, ?, ?, ?, ?, ?, ?)')->execute([$firstName, $lastName, $date, $subject, $country, serialize($phone), $email]);
    }

    protected function getMembersFromDB(): bool|array
    {
        $queryGet = 'select photo, firstName, lastName, email, subject from MemberList.Members;';
        return $this->connection()->query($queryGet)->fetchAll();
    }

    protected function searchMember($email): bool|array
    {
        $querySearch = "select  memberId from MemberList.Members where email = '$email';";
        return $this->connection()->query($querySearch)->fetchAll();
    }

    protected function update($memberId, $company, $position, $about, $photo): void
    {
        $this->connection()->prepare("update MemberList.Members set company = ?, position = ?, about = ?, photo = ?   where memberId = ?")
            ->execute([$company, $position, $about, $photo, $memberId]);
    }
}