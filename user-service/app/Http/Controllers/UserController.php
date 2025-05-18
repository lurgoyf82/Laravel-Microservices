<?php
    namespace App\Http\Controllers;

    use App\DTO\Requests\UserRequest\RequestInsertUserDto;
    use App\Services\UserServices\UserService;
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
            $userDTO = new RequestInsertUserDto(
                $request->input('name'),
                $request->input('email'),
                $request->input('password')
            );
            $user = $this->userService->login($userDTO);

            if (! $user) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            return response()->json($user);
        }
    }
