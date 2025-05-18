<?php
    namespace App\Services\UserServices;

    use App\DTO\Requests\UserRequest\RequestInsertUserDto;
    use App\DTO\Requests\UserRequest\RequestLoginUserDto;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

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

    public function login(RequestLoginUserDto $userDTO): ?User
    {
        $user = User::where('email', $userDTO->email)->first();

        if (! $user || ! Hash::check($userDTO->password, $user->password)) {
            return null;
        }

        return $user;
    }
}
