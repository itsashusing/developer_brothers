<?php

namespace App\Http\Controllers\Api;

use App\Models\TermAndCondition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\HomeBanner;
use App\Models\News;
use App\Models\PrivecyPolicy;
use App\Models\SubCategory;
use App\Models\Subject;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiAdminController extends Controller
{

    public function user_check(Request $request)
    {
        // return response()->json(['status'=>true]);
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric|exists:users,mobile_number',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first()], 422);
        }

        return response()->json(['status' => true, 'message' => 'success'], 422);
    }
    public function sign_up(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mobile_number' => 'required|numeric|unique:users,mobile_number',
            'password' => 'required|min:4',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = new User;
        $user->name = $request->name;
        $user->mobile_number = $request->mobile_number;
        $user->password = Hash::make($request->password);
        $user->save();
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'Register successfully',
            'user' => $user,
            'token' => $token
        ], 200);
    }
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric|exists:users,mobile_number',
            'password' => 'required|min:4',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = User::where('mobile_number', $request->mobile_number)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('token-name')->plainTextToken;
                return response()->json([
                    'status' => true,
                    'message' => 'Login successfully',
                    'user' => $user,
                    'token' => $token
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Password not matched',
                ], 200);
            }
        }
    }

    public function change_password(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
    }
    public function pages(Request $request)
    {

        switch ($request->type) {
            case 'terms':
                $data = TermAndCondition::first();
                break;
            case 'about':
                $data = AboutUs::first();
                break;
            case 'privacy':
                $data = PrivecyPolicy::first();
                break;
            default:
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid type provided.'
                ], 400);
        }

        if ($data) {
            return response()->json([
                'status' => true,
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No data found.'
            ], 200);
        }
    }

    public function home_banner(Request $request)
    {

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Not authorized'
            ], 200);
        }

        $data = HomeBanner::all();
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
    public function news(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Not authorized'
            ], 200);
        }

        if ($request->category_id && $request->sub_category_id) {
            $validator = Validator::make($request->all(), [
                'category_id' => 'required|numeric|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',

            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $data = News::where('category_id', $request->category_id)->where('sub_category_id', $request->sub_category_id)->get();
            return response()->json([
                'status' => true,
                'data' => $data
            ], 200);
        }



        $data = News::with('category', 'subcategory')->get();
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }

    public function categories(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('POST')) {

            $data = Category::all();
            if ($data) {
                return response()->json([
                    'status' => true,
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong.'
                ], 200);
            }
        }
    }
    public function sub_categories(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'category_id' => 'required|numeric|exists:categories,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }
            $data = SubCategory::where('category_id', $request->category_id)->get();
            if ($data) {
                return response()->json([
                    'status' => true,
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong.'
                ], 200);
            }
        }
    }
    public function subjects(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'category_id' => 'required|numeric|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }
            $data = Subject::where('category_id', $request->category_id)->where('sub_category_id', $request->sub_category_id)->get();
            if ($data) {
                return response()->json([
                    'status' => true,
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong.'
                ], 200);
            }
        }
    }
    public function default_selection(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric|exists:users,id',
                'category_id' => 'required|numeric|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }
            $user = User::find($request->user_id);
            $user->default_category_id = $request->category_id;
            $user->default_sub_category_id = $request->sub_category_id;
            $user->save();

            if ($user) {
                return response()->json([
                    'status' => true,
                    'user' => $user
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong.'
                ], 200);
            }
        }
    }

    public function subscription(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'category_id' => 'required|numeric|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $data = Subscription::where('category_id', $request->category_id)->where('sub_category_id', $request->sub_category_id)->get();

            if ($data) {
                return response()->json([
                    'status' => true,
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went wrong.'
                ], 200);
            }
        }
    }

    public function profile_update(Request $request)
    {
        $user = Auth::user();

        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric|exists:users,id',
                'name' => 'required|string',
                'mobile_number' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }


            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->mobile_number = $request->mobile_number;
            $user->save();

            return response()->json([
                'status' => true,
                'user' => $user
            ], 200);
        }
    }
}
