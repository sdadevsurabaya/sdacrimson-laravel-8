<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function register(Request $request)
    {
        //Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is valid, create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        $rawContent = $request->getContent();

        $jsonData = json_decode($rawContent, true);


        if ($jsonData != NULL) {
            $credentials = $request->json()->all();
        } else {
            $credentials = $request->only('email', 'password');
        }




        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Login credentials are invalid.'
            ], 200);
        }

        //Request is validated
        //Crean token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Login credentials are invalid.',
                ], 200);
            }
        } catch (JWTException $e) {
            return $credentials;
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
            ], 500);
        }

        // dump(JWTAuth::attempt($credentials));

        #get user
        if ($jsonData != NULL) {
            $user = DB::select('select u.*, r.name as role from users as u inner join model_has_roles as ur on u.id = ur.model_id inner join roles as r on ur.role_id = r.id where email = "' . $credentials['email'] . '"');
        } else {
            $user = DB::select('select u.*, r.name as role from users as u inner join model_has_roles as ur on u.id = ur.model_id inner join roles as r on ur.role_id = r.id where email = "' . $request->email . '"');
        }

        //dd($user);
        //Token created, return with success response and jwt token

        if ($user['0']->role == 'Sales') {
            return response()->json([
                'success' => true,
                'token' => $token,
                // 'role' => $user,
                'id' => $user['0']->id,
                'name' => $user['0']->name,
                'email' => $user['0']->email,
                'email_verified_at' => $user['0']->email_verified_at,
                'password' => $user['0']->password,
                'remember_token' => $user['0']->remember_token,
                'created_at' => $user['0']->created_at,
                'updated_at' => $user['0']->updated_at,
                'role' => $user['0']->role,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Role anda tidak memiliki akses untuk Mobile'
            ]);
        }
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }
}
