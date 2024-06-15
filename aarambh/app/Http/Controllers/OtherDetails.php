<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\HomeBanner;
use App\Models\PrivecyPolicy;
use App\Models\TermAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OtherDetails extends Controller
{
    function aboutus(Request $request, $route)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        if ($route == 'aboutus') {
            $page_data['page_title'] = 'About US';
            $page_data['get_table'] = AboutUs::all();

            if ($request->isMethod('POST')) {
                $request->validate([
                    'description' => 'required',
                ]);
                $aboutUsId = $request->input('submit');
                if ($aboutUsId) {
                    $aboutus = AboutUs::find($aboutUsId);
                    $aboutus->description = $request->input('description');
                    $aboutus->save();
                } else {
                    $aboutus = new AboutUs;
                    $aboutus->description = $request->input('description');
                    $aboutus->save();
                }
                return back()->with('success', 'About Us Updated successfully.');
            }
            return view('about_us', compact('page_data'));
        }
        if ($route == 'privecy_policy') {
            $page_data['page_title'] = 'Privecy Policy';
            $page_data['get_table'] = PrivecyPolicy::all();

            if ($request->isMethod('POST')) {
                $request->validate([
                    'description' => 'required|string',

                ]);
                $privecyPolicyId = $request->input('submit');
                if ($privecyPolicyId) {

                    $privecyPolicyId = PrivecyPolicy::find($privecyPolicyId);
                    $privecyPolicyId->description = $request->input('description');
                    $privecyPolicyId->save();
                } else {
                    $privecyPolicyId = new PrivecyPolicy;
                    $privecyPolicyId->description = $request->input('description');
                    $privecyPolicyId->save();
                }
                return back()->with('success', 'Privecy Policy Updated successfully.');
            }
            return view('privacy_policy', compact('page_data'));
        }
        if ($route == 'term_and_conditions') {
            $page_data['page_title'] = 'Term and  Condition';
            $page_data['get_table'] = TermAndCondition::all();

            if ($request->isMethod('POST')) {
                $request->validate([
                    'description' => 'required|string',

                ]);
                $TandCiD = $request->input('submit');
                if ($TandCiD) {
                    $TandCiD = TermAndCondition::find($TandCiD);

                    $TandCiD->description = $request->input('description');
                    $TandCiD->save();
                } else {
                    $TandCiD = new TermAndCondition;
                    $TandCiD->description = $request->input('description');
                    $TandCiD->save();
                }

                return back()->with('success', 'Term and  Condition Updated successfully.');
            }
            return view('terms_condition', compact('page_data'));
        }
    }

    function homebanner(Request $request, $status = null, $id = null)
    {

        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg',
                'description' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $imageName = 'public/banner_images/' . time() . '_' . $request->image->getClientOriginalName();
            $request->image->move('public/banner_images', $imageName);


            $homeBanner = new HomeBanner;
            $homeBanner->description = $request->description;
            $homeBanner->image = $imageName;
            $homeBanner->save();
            return back()->with('success', 'Banner Images added successfully.');
        }

        if ($status == 'change_status') {
            $homeBanner = HomeBanner::find($id);

            $homeBanner->status = !$homeBanner->status;
            $homeBanner->save();
            return back()->with('success', 'Status Changed successfully.');
        }
        if ($status == 'delete') {
            $homeBanner = HomeBanner::find($id);
            $homeBanner->delete();
            return back();
        }
        $dataQuery = HomeBanner::query();

        if ($request->has('true')) {
            $perPage = $request->input('pageLimit', 10);
            $searchFilter = $request->input('searchFilter');

            if ($searchFilter !== "") {
                $dataQuery->search($searchFilter);
            }

            // if ($id !== null) {
            //     $dataQuery->where(['market_type' => $id]);
            // }

            $data = $dataQuery->paginate($perPage);
            return response()->json($data);
        }
        $page_data['page_title'] = 'Home Banner';
        $page_data['get_table'] = HomeBanner::paginate(10);
        // return $page_data['get_table'];
        return view('banner_images', compact('page_data'));
    }
}
