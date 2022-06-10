<?php

namespace App\core;

class Model extends PDOAdapter
{


    public function validateInput($config, $record): string
    {
        $errors = [];
        if ($record['firstName'] === '') {
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
            //"+1 (555) 555-5555"  validation
            if (preg_match('/\+\d \(\d{3}\) \d{3}-\d{4}/i', $number)) {
                $record['phone'] = $record;
            } else {
                $errors['phone'] = "Incorrect phone number format! Got: " . $number;
            }
        }

        if ($record['email'] === '') {
            $errors['email'] = 'Input is empty!';
        } else {
            if (filter_var($record['email'], FILTER_VALIDATE_EMAIL) === false) {
                $errors['email'] = 'Incorrect email format!';
            } else {
                if (isset($this->searchMember($config, $record['email'])[0])) {
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

    public function newMemberRecord($config, array $member): bool|string
    {
        $data = $member;
        $validateResult = $this->validateInput($config, $data);
        if ($validateResult === "1") {
            $this->insertMemberToDB($config, $data['firstName'],
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

    public function updateMemberRecord($config, $data, $uploadFile, $basename): bool|array
    {
        $searchedId = $this->searchMember($config, $data['email']);
        if ($searchedId) {
            if (!$data['company']) {
                $data['company'] = '';
            }
            if (!$data['position']) {
                $data['position'] = '';
            }
            if (!$data['about']) {
                $data['about'] = '';
            }
            if (!$basename) {
                $uploadFile = '';
            }
            $this->update($config, $searchedId[0]['memberId'], $data['company'], $data['position'], $data['about'], $uploadFile);
            return true;
        }
        return $searchedId;
    }

    protected function insertMemberToDB($config, string $firstName, string $lastName, string $date, string $subject, string $country, string $phone, string $email)
    {
        $this->connection($config['database'])->prepare('insert into MemberList.Members 
    (firstName, lastName, date, subject, country, phone, email)
                                values (?, ?, ?, ?, ?, ?, ?)')->execute([$firstName, $lastName, $date, $subject, $country, serialize($phone), $email]);
    }

    public function membersCount($config): int
    {
        $members = $this->getMembersFromDB($config);
        return count($members);
    }

    protected function getMembersFromDB($config): bool|array
    {
        $queryGet = 'select photo, firstName, lastName, email, subject from MemberList.Members;';
        return $this->connection($config['database'])->query($queryGet)->fetchAll();
    }

    protected function searchMember($config, $email): bool|array
    {
        $querySearch = "select  memberId from MemberList.Members where email = '$email';";
        return $this->connection($config['database'])->query($querySearch)->fetchAll();
    }

    protected function update($config, $memberId, $company, $position, $about, $photo): void
    {
        $this->connection($this->$config['database'])->prepare("update MemberList.Members set company = ?, position = ?, about = ?, photo = ?   where memberId = ?")
            ->execute([$company, $position, $about, $photo, $memberId]);
    }
}