@section('title','دسته بندی کودک ها')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{route('admin.category.index')}}">لیست دسته ها</a>
                <a class="tab__item " href="{{route('admin.subCategory.index')}}">زیر دسته ها</a>
                <a class="tab__item is-active" href="{{route('admin.childCategory.index')}}">دسته های کودک</a>
                |
                <a class="tab__item" href="#">جستجو:</a>
                <a class="t-header-search">
                    <form>
                        <input type="text" wire:model.debounce.10000="search" class="text" placeholder="جستجو ...">
                    </form>
                </a>
                <a class="tab__item btn btn-danger text-white float-end mt-2" href="{{route('admin.childCategory.trashed')}}">
                    سطل زباله({{$trashCount}})
                </a>
            </div>
        </div>
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box" >
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>آیکون</th>
                            <th>عنوان دسته</th>
                            <th>نام دسته</th>
                            <th>نام زیر دسته اصلی</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody wire:init="loadChildCategories">
                        @if($this->readToLoad)
                            @if($childCategories->isNotEmpty())
                                @foreach($childCategories as $childCategory)
                                    <livewire:panel.admin.child-category.data-table :childCategory="$childCategory" :key="time().$childCategory->id"/>
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
                        {{$childCategories->render()}}
                    @endif

                </div>
            </div>
            <div class="col-4 bg-white padding-0">
                <livewire:panel.admin.child-category.form/>
            </div>
        </div>
    </div>
</div>
