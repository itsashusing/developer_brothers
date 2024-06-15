@php
use App\Models\SubCategory;

$sub_cat= SubCategory::where('status',1)->with('subject')
->whereHas('category', function ($query) {
$query->where('status', 1);
})
->get();

@endphp

<ul class="metismenu" id="menu">

    <li id="permission_admin_dashboard">
        <a href="{{ route('login') }}">
            <div class="parent-icon"><i class='bx bx-home-alt'></i>
            </div>
            <div class="menu-title">Dashboard</div>
        </a>
    </li>
    <li id="">
        <a href="{{ route('category') }}">
            <div class="parent-icon"><i class='bx bxs-category'></i>
            </div>
            <div class="menu-title">Category</div>
        </a>
    </li>
    <li id="">
        <a href="{{ route('subcategory') }}">
            <div class="parent-icon"><i class='bx bx-category-alt'></i>
            </div>
            <div class="menu-title">Sub Category</div>
        </a>
    </li>
    <li id="">
        <a href="{{ route('subject') }}">
            <div class="parent-icon"><i class='bx bxs-book-add'></i>
            </div>
            <div class="menu-title">Subject</div>
        </a>
    </li>

    @foreach ($sub_cat as $item)

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-book-reader'></i>
            </div>
            <div class="menu-title">{{$item->sub_category_name}}</div>
        </a>
        <ul>
            @foreach ($item->subject as $subject)
            <li> <a href="{{route('test',$subject->id)}}"><i class='bx bx-radio-circle'></i>{{$subject->subject_name}}</a>
            </li>
            @endforeach

        </ul>
    </li>
    @endforeach

    <li id="">
        <a href="{{ route('news') }}">
            <div class="parent-icon"><i class='bx bx-news'></i>
            </div>
            <div class="menu-title">News</div>
        </a>
    </li>


    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"> <i class='bx bx-cookie'></i>
            </div>


            <div class="menu-title">Other Details</div>
        </a>
        <ul>
            <li>
                <a href="{{route('aboutus')}}/aboutus">
                    <i class='bx bx-home-alt'></i>
                    About US
                </a>
            </li>
            <li>
                <a href="{{route('aboutus')}}/privecy_policy">
                    <i class='bx bxs-parking'></i>
                    Privecy Policy
                </a>
            </li>
            <li>
                <a href="{{route('aboutus')}}/term_and_conditions">
                    <i class='bx bx-transfer-alt'></i>
                    Term and Condition
                </a>
            </li>
            <li>
                <a href="{{route('homebanner')}}">
                    <i class='bx bxs-home-circle'></i>
                    Home Banner
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"> <i class="bx bx-play-circle"></i>
            </div>

            <div class="menu-title">Video</div>
        </a>
        <ul>
            <li>
                <a href="{{route('gallery')}}">
                    <i class='bx bx-radio-circle'></i>
                    Gallery
                </a>
            </li>
        </ul>
    </li>

    <li id="">
        <a href="{{ route('subscription') }}">
            <div class="parent-icon"><i class='fadeIn animated bx bx-money'></i>
            </div>
            <div class="menu-title">Subscription</div>
        </a>
    </li>

</ul>
