@section('title','محصولات')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is-active" href="{{route('admin.product.index')}}">لیست محصولات</a>
                <a class="tab__item " href="{{route('admin.subCategory.index')}}">زیر محصولات</a>
                <a class="tab__item" href="new-course.html">محصولات کودک</a>
                |
                <a class="tab__item" href="#">جستجو:</a>
                <a class="t-header-search">
                    <form>
                        <input type="text" wire:model.debounce.10000="search" class="text" placeholder="جستجو ...">
                    </form>
                </a>
                <a class="tab__item btn btn-danger text-white float-end mt-2" href="{{route('admin.product.trashed')}}">
                    سطل زباله({{$trashCount}})
                </a>
                <a class="tab__item btn btn-success text-white float-end mt-2" style="margin-left: 2px" href="{{route('admin.product.form')}}">
                   ایجاد محصول جدید
                </a>
            </div>
        </div>
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box">
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>کد محصول</th>
                            <th>عکس</th>
                            <th>عنوان محصول</th>
                            <th>دسته بندی محصول</th>
                            <th>برند محصول</th>
                            <th>قیمت محصول</th>
                            <th>قیمت  تخفیف محصول</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody wire:init="loadProducts">
                        @if($this->readToLoad)
                            @if($products->isNotEmpty())
                                @foreach($products as $product)
                                    <livewire:panel.admin.product.data-table :product="$product" :key="time().$product->id"/>
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
                        {{$products->render()}}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
