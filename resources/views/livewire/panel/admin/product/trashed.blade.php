@section('title','محصولات پاک شده')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item" href="{{route('admin.product.index')}}">لیست محصولات</a>
                <a class="tab__item " href="{{route('admin.subCategory.index')}}">زیر محصولات</a>
                <a class="tab__item" href="new-course.html">محصولات کودک</a>
                |
                <a class="tab__item" href="new-course.html">جستجو:</a>
                <a class="t-header-search">
                    <form>
                        <input type="text" wire:model.debounce.10000="search" class="text" placeholder="جستجو ...">
                    </form>
                </a>
                <a class="tab__item btn btn-danger text-white float-end mt-2" href="{{route('admin.product.trashed')}}">
                    سطل زباله({{$trashCount}})
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
                            <th>قیمت تخفیف محصول</th>
                            <th>تاریخ پاک شدن</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody wire:init="loadProducts">
                        @if($this->readToLoad)
                            @if($products->isNotEmpty())
                                @foreach($products as $product)
                                    <tr role="row" wire:key="{{$product->id}}" id="row{{$product->id}}">
                                        <td>
                                            <a href="">{{$product->id}}</a>
                                        </td>
                                        <td>
                                            {{$product->code}}
                                        </td>
                                        <td>
                                            <img src="{{$product->getFirstMediaUrl(__('messages.product.media-collection'),'thumb')}}" width="100px"/>
                                        </td>
                                        <td>{{$product->title}}</td>
                                        <td>
                                            <ul>
                                                <li>{{$product->category->title ?? ''}}</li>
                                                <li>&nbsp;{{$product->subCategory->title ?? ''}}</li>
                                                <li>&nbsp;&nbsp;{{$product->childCategory->title ?? ''}}</li>
                                            </ul>
                                        </td>
                                        <td>
                                            {{$product->brand->title}}
                                        </td>
                                        <td>{{number_format($product->price)}} تومان</td>
                                        <td>{{number_format($product->discount)}}تومان</td>
                                        <td>
                                            @if($product->is_published)
                                                <span class="badge bg-success">
                                                    منشر شده
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    مخفی شده
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{\Hekmatinasser\Verta\Verta::instance($product->deleted_at)->format('%B %d، %Y')}}
                                        </td>
                                        <td>
                                            <a wire:click.prevent="recovery({{$product->id}})" href="#" title="بازیابی محصول">
                                                <i class="fa fa-undo"></i>
                                            </a>
                                            &nbsp;
                                            &nbsp;
                                            <a wire:click.prevent="destroy({{$product->id}})" href="#" title="حذف">
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
                        {{$products->render()}}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
