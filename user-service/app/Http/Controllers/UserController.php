<?php
    namespace App\Http\Controllers;

    use App\DTO\Requests\UserRequest\RequestDeleteUserDto;
    use App\DTO\Requests\UserRequest\RequestInsertUserDto;
    use App\DTO\Requests\UserRequest\RequestLoginUserDto;
    use App\DTO\Requests\UserRequest\RequestUpdateUserDto;
    use App\Services\UserServices\UserService;
    use App\Models\User;
    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        private UserService $userService;

        public function __construct(UserService $userService)
        {
            $this->userService = $userService;
        }

        public function register(Request $request)
        {
            $userDTO = new RequestInsertUserDto(
                $request->input('name'),
                $request->input('email'),
                $request->input('password')
            );
            $user = $this->userService->createUser($userDTO);
            return response()->json($user);
        }

    public function login(Request $request)
    {
        $userDTO = new RequestLoginUserDto(
            $request->input('email'),
            $request->input('password')
        );
        $user = $this->userService->login($userDTO);

            if (! $user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json($user);
    }

    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users);
    }

    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $userDTO = new RequestUpdateUserDto(
            (string) $user->id,
            $request->input('name', $user->name),
            $request->input('email', $user->email),
            $request->input('password', $user->password)
        );

        $updated = $this->userService->updateUser($userDTO);

        return response()->json($updated);
    }

    public function destroy(User $user)
    {
        $userDTO = new RequestDeleteUserDto((string) $user->id);
        $this->userService->deleteUser($userDTO);
        return response()->json(null, 204);
    }
}
