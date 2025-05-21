<?php
    namespace App\Services\UserServices;

    use App\DTO\Requests\UserRequest\RequestDeleteUserDto;
    use App\DTO\Requests\UserRequest\RequestInsertUserDto;
    use App\DTO\Requests\UserRequest\RequestLoginUserDto;
    use App\DTO\Requests\UserRequest\RequestUpdateUserDto;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Collection;

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

    public function getAllUsers(): Collection
    {
        return User::all();
    }

    public function updateUser(RequestUpdateUserDto $userDTO): ?User
    {
        $user = User::find($userDTO->idUser);
        if (! $user) {
            return null;
        }

        $user->name = $userDTO->name;
        $user->email = $userDTO->email;

        if ($userDTO->password !== '') {
            $user->password = $userDTO->password;
        }

        $user->save();

        return $user;
    }

    public function deleteUser(RequestDeleteUserDto $userDTO): bool
    {
        $user = User::find($userDTO->idUser);
        if (! $user) {
            return false;
        }

        return (bool) $user->delete();
    }
}
