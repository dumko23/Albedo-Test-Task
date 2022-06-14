<?php

namespace App\app\views;

use App\app\models\Model;

class View extends Model
{
    public function showMembers($config)
    {
        $result = $this->getMembersFromDB($config);
        foreach ($result as $member) {
            if ($member['photo'] === '') {
                $member['photo'] = 'source/uploads/default-image.png';
            }
            echo "<table class='member-table'>
                <tr>
                    <td class='descr'>Photo</td>
                    <td><img src='{$member['photo']}' alt='user photo'></td>
                </tr>
                <tr>
                    <td class='descr'>Full Name</td>
                    <td>{$member['firstName']} {$member['lastName']}</td>
                </tr>
                <tr>
                    <td class='descr'>Report Subject</td>
                    <td>{$member['subject']}</td>
                </tr>
                <tr>
                    <td class='descr'>Email</td>
                    <td><a href='mailto:{$member['email']}'>{$member['email']}</a></td>
                </tr>
            </table>
            ";
        }
    }

    public function showView($view){
        return require $view;
    }
}