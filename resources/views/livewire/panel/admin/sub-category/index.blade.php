@section('title','زیر دسته بندی ها')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{route('admin.category.index')}}">لیست دسته ها</a>
                <a class="tab__item is-active" href="{{route('admin.subCategory.index')}}">زیر دسته ها</a>
                <a class="tab__item" href="new-course.html">دسته های کودک</a>
                |
                <a class="tab__item" href="new-course.html">جستجو:</a>
                <a class="t-header-search">
                    <form>
                        <input type="text" wire:model.debounce.10000="search" class="text" placeholder="جستجو ...">
                    </form>
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
                            <th>نام دسته اصلی</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody wire:init="loadCategories">
                        @if($this->readToLoad)
                            @if($subCategories->isNotEmpty())
                                @foreach($subCategories as $subCategory)
                                    <livewire:panel.admin.sub-category.data-table :subCategory="$subCategory" :key="time().$subCategory->id"/>
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
            <div class="col-4 bg-white padding-0">
                <livewire:panel.admin.sub-category.form/>
            </div>
        </div>
    </div>
</div>
