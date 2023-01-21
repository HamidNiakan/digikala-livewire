@section('title','زیر دسته بندی ها')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{route('admin.category.index')}}">لیست دسته ها</a>
                <a class="tab__item is-active" href="{{route('admin.subCategory.index')}}">زیر دسته ها</a>
                <a class="tab__item" href="{{route('admin.childCategory.index')}}">دسته های کودک</a>
                |
                <a class="tab__item" href="new-course.html">جستجو:</a>
                <a class="t-header-search">
                    <form>
                        <input type="text" wire:model.debounce.10000="search" class="text" placeholder="جستجو ...">
                    </form>
                </a>
                <a class="tab__item btn btn-danger text-white float-end mt-2" href="{{route('admin.subCategory.trashed')}}">
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
                            @if($subCategories->isNotEmpty())
                                @foreach($subCategories as $subCategory)
                                    <tr role="row"  id="row{{$subCategory->id}}">
                                        <td><a href="">{{$subCategory->id}}</a></td>
                                        <td><img src="{{$subCategory->getFirstMediaUrl('subCategory-icon','thumb')}}" width="100px"/></td>
                                        <td><a href="">{{$subCategory->title}}</a></td>
                                        <td><a href="">{{$subCategory->slug}}</a></td>
                                        <td>
                                            @if($subCategory->is_published)
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
                                            {{\Hekmatinasser\Verta\Verta::instance($subCategory->deleted_at)->format('%B %d، %Y')}}
                                        </td>
                                        <td>
                                            <a wire:click.prevent="recoveryCategory({{$subCategory->id}})" href="#"  title="بازیابی دسته بندی">
                                                <i class="fa fa-undo"></i>
                                            </a>
                                            &nbsp;
                                            &nbsp;
                                            <a wire:click.prevent="destroyCategory({{$subCategory->id}})" href="#"  title="حذف">
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
                        {{$subCategories->render()}}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
