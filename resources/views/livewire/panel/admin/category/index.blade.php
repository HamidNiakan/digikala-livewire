@section('title','دسته بندی ها')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item {{request()->routeIs('admin.category.index') ? 'is-active' : ''}}" href="{{route('admin.category.index')}}">لیست دسته ها</a>
                <a class="tab__item" href="approved.html">زیر دسته ها</a>
                <a class="tab__item" href="new-course.html">دسته های کودک</a>
                |
                <a class="tab__item" href="new-course.html">جستجو:</a>
                <a class="t-header-search">
                    <form action="" onclick="event.preventDefault();">
                        <input type="text"  class="text"  placeholder="جستجو ...">
                    </form>
                </a>
            </div>
        </div>
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>آیکون</th>
                            <th>عنوان دسته</th>
                            <th>نام دسته</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <livewire:panel.admin.category.data-table :category="$category" :key="time().$category->id"/>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white padding-0">
                <livewire:panel.admin.category.form/>
            </div>
        </div>
    </div>
</div>
