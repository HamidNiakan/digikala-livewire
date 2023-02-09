@section('title','برند ها')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item " href="{{route('admin.brand.index')}}">لیست برندها</a>
                |
                <a class="tab__item" href="new-course.html">جستجو:</a>
                <a class="t-header-search">
                    <form>
                        <input type="text" wire:model.debounce.10000="search" class="text" placeholder="جستجو ...">
                    </form>
                </a>
                <a class="tab__item btn btn-danger text-white float-end mt-2" href="{{route('admin.brand.trashed')}}">
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
                            <th>نام برند</th>
                            <th>وضعیت</th>
                            <th>تاریخ پاک شدن</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody wire:init="loadBrands">
                        @if($this->readToLoad)
                            @if($brands->isNotEmpty())
                                @foreach($brands as $brand)
                                    <tr role="row"  id="row{{$brand->id}}">
                                        <td><a href="">{{$brand->id}}</a></td>
                                        <td><img src="{{$brand->getFirstMediaUrl(__('messages.brand.media-collection'),'thumb')}}" width="100px"/></td>
                                        <td><a href="">{{$brand->title}}</a></td>
                                        <td>
                                            @if($brand->is_published)
                                                <span class="badge bg-success">
                                                    منتشر
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    مخفی
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{\Hekmatinasser\Verta\Verta::instance($brand->deleted_at)->format('%B %d، %Y')}}
                                        </td>
                                        <td>
                                            <a wire:click.prevent="recovery({{$brand->id}})" href="#"  title="بازیابی برند">
                                                <i class="fa fa-undo"></i>
                                            </a>
                                            &nbsp;
                                            &nbsp;
                                            <a wire:click.prevent="destroy({{$brand->id}})" href="#"  title="حذف">
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
                        {{$brands->render()}}
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
