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
            var_dump('UserController');
            $this->userService = $userService;
        }

        public function createUser(Request $request)
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
            return response()->json($user);
        }

        public function cacchio(Request $request)
        {
            var_dump($request->all());
            return response()->json(['message' => 'Hello world!']);
        }
    }
