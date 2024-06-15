<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function subscription(Request $request, $status = null, $id = null)
    {

        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        $dataQuery = Subscription::with('category', 'subcategory');
        if ($request->has('true')) {
            $perPage = $request->input('pageLimit', 10);
            $searchFilter = $request->input('searchFilter');

            if ($searchFilter !== "") {
                $dataQuery->search($searchFilter);
            }
            $data = $dataQuery->paginate($perPage);
            return response()->json($data);
        }

        if ($status == 'change_status') {

            $subscription = Subscription::find($id);

            $subscription->status = !$subscription->status;
            $subscription->save();
            return back()->with('success', 'Subscription Updated successfully.');
        }
        if ($status == 'delete') {
            $subscription = Subscription::find($id);
            $subscription->delete();
            return back()->with('success', 'Subscription deleted successfully.');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'category' => 'required|string|exists:categories,id',
                'subcategory' => 'required|string|exists:sub_categories,id',
                'subscription' => 'required|string',
                'cost' => 'required|numeric',
                'duration' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }


            $subcription = new Subscription;
            $subcription->subscription = $request->subscription;
            $subcription->cost = $request->cost;
            $subcription->duration = $request->duration;
            $subcription->category_id = $request->category;
            $subcription->sub_category_id = $request->subcategory;

            $subcription->save();
            return  back()->with('success', 'New Subscription added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'category' => 'required|string|exists:categories,id',
                'subcategory' => 'required|string|exists:sub_categories,id',
                'subscription' => 'required|string',
                'cost' => 'required|numeric',
                'duration' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }


            $subcription = Subscription::find($request->id);
            $subcription->subscription = $request->subscription;
            $subcription->cost = $request->cost;
            $subcription->duration = $request->duration;
            $subcription->category_id = $request->category;
            $subcription->sub_category_id = $request->subcategory;

            $subcription->save();
            return  back()->with('success', 'Subscription updated successfully.');
        }
        $page_data['page_title'] = 'Subscriptions';
        $page_data['get_table'] = Subscription::with('category', 'subcategory')->paginate(10);
        // return $page_data['get_table'] ;
        return view('admin.subscription', compact('page_data'));
    }
}
