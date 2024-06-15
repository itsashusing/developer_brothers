<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\News;
use App\Models\Quiz;
use App\Models\SubCategory;
use App\Models\Subject;
use App\Models\Gallery;
use App\Models\Test;
use App\Models\VideoUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    function login(Request $request)
    {
        if (!session()->has('admin_id')) {
            if ($request->isMethod('POST')) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email|exists:admins,email',
                    'password' => 'required|string'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withInput()->with('error', $validator->errors()->first());
                }
                $admin = Admin::where('email', $request->email)->first();

                if ($admin) {
                    if (Hash::check($request->password, $admin->password)) {
                        $request->session()->put('admin_id', $admin->id);
                        $page_data['page_title'] = 'Dashboard';
                        return view('admin_dashboard', compact('page_data'));
                    } else {
                        return redirect()->back()->withInput()->with('error', 'Wrong Password');
                    }
                }
            }
            //==== POST END ====
            return view('login');
        }
        return view('admin_dashboard');
    }

    function logout(Request $request)
    {
        if (session()->get('admin_id')) {
            $request->session()->forget('admin_id');
            return redirect()->route('login');
        } else {
            return redirect()->back()->with('error', 'Not autherized');
        }
    }

    function category(Request $request, $status = null, $id = null)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        if ($status == 'change_status') {
            $category = Category::with('subcategory.subject')->find($id);

            if ($category->status) {
                $category->status = !$category->status;
                $category->save();
                $category->subcategory()->update(['status' => 0]);
                return back()->with('success', 'Category Status updated successfully.');
            } else {
                $category->status = !$category->status;
                $category->save();
                return back()->with('success', 'Category Status updated successfully.');
            }
        }
        if ($status == 'delete') {
            $category = Category::find($id);
            $category->delete();
            return back()->with('success', 'Category deleted successfully.');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'category' => 'required|string|unique:categories,category_name',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $cat = new Category;
            $cat->category_name = $request->category;
            $cat->save();
            return redirect()->back()->with('success', 'Category added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'category' => 'required|string|unique:categories,category_name',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $cat = Category::find($request->id);
            $cat->category_name = $request->category;
            $cat->save();
            return redirect()->back()->with('success', 'Category updated successfully.');
        }
        $page_data['page_title'] = 'Category';
        $page_data['get_table'] = Category::paginate(10);
        // return $page_data;
        return view('admin.category', compact('page_data'));
    }
    function subcategory(Request $request, $status = null, $id = null)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        if ($status == 'change_status') {
            $sbcategory = SubCategory::with('category', 'subject')->find($id);

            if ($sbcategory->category->status) {
                if ($sbcategory->status) {
                    $sbcategory->status = !$sbcategory->status;
                    $sbcategory->save();
                    $sbcategory->subject()->update(['status' => 0]);
                    return back()->with('success', 'Subcategory Status is updated.');
                } else {
                    $sbcategory->status = !$sbcategory->status;
                    $sbcategory->save();
                    return back()->with('success', 'Subcategory Status is updated.');
                }
            } else {
                return back()->with('error', 'Category Status is inactive.');
            }
        }
        if ($status == 'delete') {
            $sbcategory = SubCategory::find($id);
            $sbcategory->delete();
            return back()->with('success', 'Sub Category deleted successfully.');
        }
        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'subcategory' => 'required|string|unique:sub_categories,sub_category_name',
                'category' => 'required|exists:categories,id'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $sbcat = new SubCategory();
            $sbcat->sub_category_name = $request->subcategory;
            $sbcat->category_id = $request->category;
            $sbcat->save();

            return back()->with('success', 'Sub Category added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'subcategory' => 'required|string|unique:sub_categories,sub_category_name',
                'category' => 'required|exists:categories,id'
            ]);

            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }


            $sbcat = SubCategory::find($request->id);
            $sbcat->sub_category_name = $request->subcategory;
            $sbcat->category_id = $request->category;
            $sbcat->save();
            return back()->with('success', 'Sub Category updated successfully.');
        }
        $page_data['page_title'] = 'Sub Category';
        $page_data['get_table'] = SubCategory::with('category')->paginate(10);
        // return $page_data;
        return view('admin.subcategory', compact('page_data'));
    }
    function subject(Request $request, $status = null, $id = null)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        $dataQuery = Subject::with('sub_category.category');
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
            $sub = Subject::with('sub_category')->find($id);
            // return $sub;
            if ($sub->sub_category->status) {
                $sub->status = !$sub->status;
                $sub->save();
                return redirect()->back()->with('success', 'Sunject Status updated.');
            } else {
                return redirect()->back()->with('error', 'Sub Category Status is inactive.');
            }
        }
        if ($status == 'delete') {
            $sub = Subject::find($id);
            $sub->delete();
            return back()->with('success', 'Subject deleted successfully.');
        }

        if ($request->isMethod('POST')) {

            $validator = Validator::make($request->all(), [
                'subject_name' => 'required|string',
                'category' => 'required|exists:categories,id',
                'subcategory' => 'required|exists:sub_categories,id',
                'image' => 'required|'
            ]);
            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }

            $imageName = 'public/subject_images/' . time() . '_' . $request->image->getClientOriginalName();
            $request->image->move('public/subject_images', $imageName);

            $sub = new Subject();
            $sub->subject_name = $request->subject_name;
            $sub->category_id = $request->category;
            $sub->sub_category_id = $request->subcategory;
            $sub->image = $imageName;

            $sub->save();
            return back()->with('success', 'Subject added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'subject_name' => 'required|string',
                'category' => 'required|exists:categories,id',
                'subcategory' => 'required|exists:sub_categories,id',

            ]);

            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }
            if ($request->image) {
                $imageName = 'public/subject_images/' . time() . '_' . $request->image->getClientOriginalName();
                $request->image->move('public/subject_images', $imageName);
            }

            $sub = Subject::find($request->id);
            $sub->subject_name = $request->subject_name;
            $sub->category_id = $request->category;
            $sub->sub_category_id = $request->subcategory;
            if ($request->image) {

                $sub->image = $imageName;
            }
            $sub->save();
            return back()->with('success', 'Subject updated successfully.');
        }


        $page_data['page_title'] = 'Subject';
        // $page_data['get_table']= Subject::all();
        $page_data['get_table'] = Subject::with('sub_category.category')
            ->paginate(10);
        // return $page_data['get_table'];
        return view('admin.subject', compact('page_data'));
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = SubCategory::where('category_id', $categoryId)->where('status', 1)->get();
        // dd($subcategories); 
        
        return response()->json($subcategories);
    }



    //

    function news(Request $request, $status = null, $id = null)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        $dataQuery = News::query();
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
        $page_data['page_title'] = 'News';
        $page_data['get_table'] = News::paginate(10);
        return view('news', compact('page_data'));
    }

    function addnews(Request $request, $status = null, $id = null)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        if ($status == 'change_status') {

            $news = News::find($id);
            $news->status = !$news->status;
            $news->save();
            return back()->with('success', 'News status changed successfully.');
        }
        if ($status == 'delete') {
            $news = News::find($id);
            $news->delete();
            return back()->with('success', 'News deleted successfully.');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'category' => 'required|exists:categories,id',
                'subcategory' => 'required|exists:sub_categories,id',
                'image' => 'required|image|mimes:jpeg,png,jpg',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $imageName = 'public/news_images/' . time() . '_' . $request->image->getClientOriginalName();
            $request->image->move('public/news_images', $imageName);

            $news = new News;
            $news->title = $request->title;
            $news->description = $request->description;
            $news->category_id = $request->category;
            $news->sub_category_id = $request->subcategory;
            $news->image = $imageName;
            $news->save();
            return redirect()->route('news')->with('success', 'News added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'category' => 'required|exists:categories,id',
                'subcategory' => 'required|exists:sub_categories,id',

            ]);

            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }
            if ($request->image) {
                $imageName = 'public/news_images/' . time() . '_' . $request->image->getClientOriginalName();
                $request->image->move('public/news_images', $imageName);
            }

            $news = News::find($request->id);
            $news->title = $request->title;
            $news->description = $request->description;
            $news->category_id = $request->category;
            $news->sub_category_id = $request->subcategory;
            if ($request->image) {

                $news->image = $imageName;
            }
            $news->save();
            return redirect()->route('news')->with('success', 'News Updated successfully.');
        }
        return view('add_news');
    }

    function updatenews(Request $request, $id)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        
        $page_data['page_title'] = "Update News";
        $page_data['get_table'] = News::find($id);
        // return $page_data['get_table']->description;
        return view('edit_news', compact('page_data'));
    }


    //  Gallery 

    function gallery(Request $request, $status = null, $id = null)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }
        $dataQuery = Gallery::query();
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

            $news = Gallery::find($id);
            $news->status = !$news->status;
            $news->save();
            return back()->with('success', 'Gallery updated successfully.');
        }
        if ($status == 'delete') {
            $news = Gallery::find($id);
            $news->delete();
            return back()->with('success', 'Gallery deleted successfully.');
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'video' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $videoName = 'public/gallery_videos/' . time() . '_' . $request->video->getClientOriginalName();
            $request->video->move('public/gallery_videos', $videoName);

            $gallery = new Gallery;
            $gallery->title = $request->title;
            $gallery->video = $videoName;
            $gallery->save();
            return back()->with('success', 'Gallery item added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string',

            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }
            if ($request->video) {
                $videoName = 'public/gallery_videos/' . time() . '_' . $request->video->getClientOriginalName();
                $request->video->move('public/gallery_videos', $videoName);
            }


            $gallery = Gallery::find($request->id);
            $gallery->title = $request->title;
            if ($request->video) {

                $gallery->video = $videoName;
            }
            $gallery->save();
            return back()->with('success', 'Gallery item updated successfully.');
        }

        $page_data['page_title'] = 'Gallery';
        $page_data['get_table'] = Gallery::paginate(10);

        return view('admin.gallery', compact('page_data'));
    }

    function test(Request $request, $id, $status = null)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }

        if ($status == 'change_status') {

            $news = Test::find($id);
            $news->status = !$news->status;
            $news->save();
            return back();
        }
        if ($status == 'delete') {
            $news = Test::find($id);
            $news->delete();
            return back();
        }
        $dataQuery = Test::where('subject_id', $id)->with('quiz', 'video_url');
        if ($request->has('true')) {
            $perPage = $request->input('pageLimit', 10);
            $searchFilter = $request->input('searchFilter');

            if ($searchFilter !== "") {
                $dataQuery->search($searchFilter);
            }
            $data = $dataQuery->paginate($perPage);
            return response()->json($data);
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'set' => 'required|string|unique:tests,set',
                'id' => 'required|exists:subjects,id'
            ]);

            if ($validator->fails()) {
                return back()->withInput()->with('error', $validator->errors()->first());
            }

            $test = new Test;
            $test->set = $request->set;
            $test->subject_id = $request->id;
            $test->save();
            return back()->with('success', 'Test item added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'set' => 'required|string|unique:tests,set',
                'subject_id' => 'required|exists:subjects,id'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $test = Test::find($request->id);
            $test->set = $request->set;
            $test->subject_id = $request->subject_id;
            $test->save();
            return back()->with('success', 'Test item updated successfully.');
        }
        $page_data['page_title'] = 'Test';
        $page_data['subject_id'] = $id;
        $page_data['get_table'] = Test::where('subject_id', $id)->with('quiz', 'video_url')->paginate(10);
        return view('admin.test', compact('page_data'));
    }
    function quiz(Request $request, $id, $status = null)
    {
        if (!$request->session()->get('admin_id')) {
            return redirect()->route('login');
        }

        if ($status == 'change_status') {

            $news = Quiz::find($id);

            $news->status = !$news->status;
            $news->save();
            return back()->with('success', 'Quiz Updated successfully.');
        }
        if ($status == 'delete') {
            $news = Quiz::find($id);
            $news->delete();
            return back()->with('success', 'Quiz deleted successfully.');
        }
        $dataQuery = Quiz::where('test_id', $id);
        if ($request->has('true')) {
            $perPage = $request->input('pageLimit', 10);
            $searchFilter = $request->input('searchFilter');

            if ($searchFilter !== "") {
                $dataQuery->search($searchFilter);
            }
            $data = $dataQuery->paginate($perPage);
            return response()->json($data);
        }
        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'question' => 'required|string|unique:quizzes,question',
                'option1' => 'required|string',
                'option2' => 'required|string',
                'option3' => 'required|string',
                'option4' => 'required|string',
                'right_answer' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $quiz = new Quiz;
            $quiz->question = $request->question;
            $quiz->option1 = $request->option1;
            $quiz->option2 = $request->option2;
            $quiz->option3 = $request->option3;
            $quiz->option4 = $request->option4;
            $quiz->right_answer = $request->right_answer;
            $quiz->test_id = $request->id;
            $quiz->save();
            return back()->with('success', 'Quiz added successfully.');
        }
        if ($request->isMethod('PUT')) {
            $validator = Validator::make($request->all(), [
                'question' => 'required|string|unique:quizzed,question',
                'option1' => 'required|string',
                'option2' => 'required|string',
                'option3' => 'required|string',
                'option4' => 'required|string',
                'right_answer' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $quiz = Quiz::find($request->id);
            $quiz->question = $request->question;
            $quiz->option1 = $request->option1;
            $quiz->option2 = $request->option2;
            $quiz->option3 = $request->option3;
            $quiz->option4 = $request->option4;
            $quiz->right_answer = $request->right_answer;
            // $quiz->test_id = $request->id;
            $quiz->save();
            return back()->with('success', 'Test item updated successfully.');
        }
        $page_data['page_title'] = 'All Questions';
        $page_data['test_id'] = $id;
        $page_data['get_table'] = Quiz::where('test_id', $id)

            ->paginate(10);
        // return $page_data;
        return view('admin.quiz', compact('page_data'));
    }

    public function video_url(Request $request)
    {


        if ($request->isMethod('POST')) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|string',
                'video_url' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', $validator->errors()->first());
            }

            $video_obj = new VideoUrl;
            $video_obj->test_id = $request->id;
            $video_obj->video_url = $request->video_url;
            $video_obj->save();
            return back()->with('success', 'Video saved successfully.');
        }
    }
}
