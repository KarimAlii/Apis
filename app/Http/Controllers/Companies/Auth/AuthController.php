<?php

namespace App\Http\Controllers\Companies\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\Auth\LoginRequest;
use App\Http\Requests\Companies\Auth\StoreCompanyRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(
        LoginRequest $request
    ): JsonResponse
    {
        $user = User::where('email',$request->email)->first();

        if($user && Hash::check($request->password,$user->password)){

            return response()->json([
                "message" => "logged in successfully",
                "token" => $user->createToken($request->email)->plainTextToken,
                "status" => Response::HTTP_OK
            ],Response::HTTP_OK);

        }
        return response()->json([
            "message" => "Invalid username or password",
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }

    /**
     * @param StoreCompanyRequest $request
     * @return JsonResponse
     */
    public function register(
        StoreCompanyRequest $request
    ): JsonResponse
    {
        DB::transaction(function () use ($request){
            $user = User::create([
                "name" => $request->user_name,
                "email" => $request->user_email,
                "phone" => $request->user_phone,
                "password" => Hash::make($request->password)
            ]);

            $company =$user->company()->create([
                "name" => $request->company_name,
                "size" => $request->company_size,
                "industry" => $request->company_industry
            ]);

            $company->address()->create([
                "address" => $request->company_address,
                "lat" => $request->company_lat,
                "lng" => $request->company_lng
            ]);
        },$deadlockRetries = 5);

        return response()->json([
            "message" => "Company registered successfully.",
            "status" => Response::HTTP_CREATED
        ],Response::HTTP_CREATED);
    }
}
