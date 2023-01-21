@section('title','دسته بندی ها')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{route('admin.category.index')}}">لیست دسته ها</a>
                <a class="tab__item " href="{{route('admin.subCategory.index')}}">زیر دسته ها</a>
                <a class="tab__item" href="{{route('admin.childCategory.index')}}">دسته های کودک</a>
                |
                <a class="tab__item" href="new-course.html">جستجو:</a>
                <a class="t-header-search">
                    <form>
                        <input type="text" wire:model.debounce.10000="search" class="text" placeholder="جستجو ...">
                    </form>
                </a>
                <a class="tab__item btn btn-danger text-white float-end mt-2" href="{{route('admin.category.trashed')}}">
                    سطل زباله({{$trashCount}})
                </a>
            </div>
        </div>
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box" >
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>آیکون</th>
                            <th>عنوان دسته</th>
                            <th>نام دسته</th>
                            <th>وضعیت</th>
                            <th>تاریخ پاک شدن</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody wire:init="loadCategories">
                        @if($this->readToLoad)
                            @if($categories->isNotEmpty())
                                @foreach($categories as $category)
                                    <tr role="row"  id="row{{$category->id}}">
                                        <td><a href="">{{$category->id}}</a></td>
                                        <td><img src="{{$category->getFirstMediaUrl('category-icon','thumb')}}" width="100px"/></td>
                                        <td><a href="">{{$category->title}}</a></td>
                                        <td><a href="">{{$category->slug}}</a></td>
                                        <td>
                                            @if($category->is_published)
                                                <span class="badge bg-success">
                                                    فعال
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    غیرفعال
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{\Hekmatinasser\Verta\Verta::instance($category->deleted_at)->format('%B %d، %Y')}}
                                        </td>
                                        <td>
                                            <a wire:click.prevent="recoveryCategory({{$category->id}})" href="#"  title="بازیابی دسته بندی">
                                                <i class="fa fa-undo"></i>
                                            </a>
                                            &nbsp;
                                            &nbsp;
                                            <a wire:click.prevent="destroyCategory({{$category->id}})" href="#"  title="حذف">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        اطلاعات یافت نشد
                                    </td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </td>
                            </tr>
                        @endif

                        </tbody>
                    </table>
                    @if($this->readToLoad)
                        {{$categories->render()}}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
