@section('title','یرندها')
<div>
    <div class="main-content padding-0 categories">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item is_active" href="{{route('admin.brand.index')}}">لیست برندها</a>
                |
                <a class="tab__item" href="#">جستجو:</a>
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
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="table__box" >
                    <table class="table">

                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>آیکون</th>
                            <th>نام برند</th>
                            <th>دسته بندی</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody wire:init="loadBrands">
                        @if($this->readToLoad)
                            @if($brands->isNotEmpty())
                                @foreach($brands as $brand)
                                    <livewire:panel.admin.brand.data-table :brand="$brand" :key="time().$brand->id"/>
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
            <div class="col-4 bg-white padding-0">
                <livewire:panel.admin.brand.form/>
            </div>
        </div>
    </div>
</div>
