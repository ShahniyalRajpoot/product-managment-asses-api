<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Product;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;
use App\Models\User;
use App\Models\Image;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function register(Request $request ){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors(),
                'status' =>201
            ];

            return response()->json($response,201);
        }
        $inputData = $request->all();
        $user = User::create($inputData);

        $success['token'] = $user->createToken('MyApp')->plainTextToken;
        $success['name'] = $user->name;

        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'User Register Successfully',
            'status' =>200
        ];

        return response()->json($response,200);
    }

    public function login(Request $request ){
        if(Auth::attempt(['email' => $request->email,'password'=> $request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User Login Successfully',
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Unauthorized',
                'status' => 400,
            ];
            return response()->json($response);
        }

    }

    public function logout(){
        $user = Auth::user();
        $user->tokens()->delete();
        $response = [
            'success' => true,
            'message' => 'User Logout Successfully ',
            'status' => 200,
        ];
        return response()->json($response,200);

    }

    public function getUserData(Request $request){
        $AuthUserInfo = $request->user();
        $UserInfo     = User::with('products')->find($AuthUserInfo['id']);
        $response = [
            'success' => true,
            'data'=>$UserInfo,
            'message' => 'User Login sucessfully',
            'status' => 200,
        ];

        return response()->json($response,200);
    }


    public function saveNewProduct(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors(),
                'status' =>201
            ];

            return response()->json($response,201);
        }
        $AuthUserInfo = $request->user();
        $allInfo = $request->only(['name','description','price','stock']);
        $allInfo['user_id'] =$AuthUserInfo['id'];
        $ProductInfo = Product::create($allInfo);
        $response = [
            'success' => true,
            'message' => 'New Product Created!!',
            'status' => 200,
        ];

        return response()->json($response,200);
    }

    public function deleteProduct(Request $request){
        $ProductInfo = Product::where('id',$request->id)->delete();
            $response = [
                'success' => true,
                'message' => 'Product is Deleted',
                'status' => 200,
            ];
            return response()->json($response,200);


    }

    public function editProduct(Request $request){
        $ProductInfo = product::find($request->id);
        $response = [
            'success' => true,
            'data'=>$ProductInfo,
            'status' => 200,
        ];

        return response()->json($response,200);
    }

    public function updateProduct(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        if($validator->fails()){
            $response = [
                'success' => false,
                'message' => $validator->errors(),
                'status' =>201
            ];
            return response()->json($response,201);
        }
        $allInfo = $request->only(['name','description','price','stock']);
        $ProductInfo = Product::where('id',$request->id)->update($allInfo);
            $response = [
                'success' => true,
                'message' => 'Product Updated!!',
                'status' => 200,
            ];

        return response()->json($response,200);
    }
}
