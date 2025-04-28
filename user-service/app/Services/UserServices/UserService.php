<?php
    namespace App\Services\UserServices;

    use App\DTO\Requests\UserRequest\RequestInsertUserDto;
    use App\Models\User;

    class UserService
    {
        public function createUser(RequestInsertUserDto $userDTO): User
        {
            $user = new User();

            $user->name = $userDTO->name;
            $user->email = $userDTO->email;
            $user->password = $userDTO->password;

            $user->save();

            return $user;
        }
    }
