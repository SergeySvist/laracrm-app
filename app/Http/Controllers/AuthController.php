<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiUnauthorizedException;
use App\Http\Requests\Auth\SigninRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    use ApiResponser;

    public function signup(SignupRequest $request){
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $this->successResponse($user->toArray(), null, Response::HTTP_CREATED);
    }

    public function signin(SigninRequest $request){
        $data = $request->validated();

        if(! Auth::attempt($data))
            throw new ApiUnauthorizedException();

        return $this->successResponse(
            ['access_token'=>Auth::user()->createToken('access_token')->plainTextToken],
        );
    }

    public function signout(){
        Auth::user()->tokens()->delete();

        return $this->successResponse();
    }
}
