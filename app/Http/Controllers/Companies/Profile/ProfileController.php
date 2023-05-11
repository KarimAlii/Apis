<?php

namespace App\Http\Controllers\Companies\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\Profile\UpdateProfileRequest;
use App\Http\Resources\Companies\Profile\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * @return UserResource
     */
    public function index():UserResource
    {
        return UserResource::make(auth()->user()->load('company','company.address','company.image'));
    }

    /**
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     */
    public function Update(
        UpdateProfileRequest $request
    ): JsonResponse
    {
        DB::transaction(function () use ($request){

            $user = auth()->user();

            $user->update([
                "name" => $request->user_name,
                "email" => $request->user_email,
                "phone" => $request->user_phone,
                "password" => Hash::make($request->password)
            ]);

            $user->company()->update([
                "name" => $request->company_name,
                "size" => $request->company_size,
                "industry" => $request->company_industry
            ]);

            $user->company->address()->update([
                "address" => $request->company_address,
                "lat" => $request->company_lat,
                "lng" => $request->company_lng
            ]);

            if(is_file($request->image)){
                $image=$request->image;
                $profileImage=Time() . "_" . $image->getClientOriginalName();
                $image->move('posts',$profileImage);

                $user->company->image()->updateorCreate([
                   "image" => $profileImage
                ]);
            }
        },$deadlockRetries = 5);

        return response()->json([
            "message" => "Profile updated successfully.",
            "status" => Response::HTTP_OK
        ],Response::HTTP_OK);
    }
}
