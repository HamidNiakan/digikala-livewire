<div>
    @section('title','ویرایش محصول ')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش محصول {{$product->title}} </p>
        <div class="col-12 bg-white padding-0">
            <form wire:submit.prevent="update" class="padding-20 needs-validation">
                <div class="row">
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.debounce.1000ms="title" class="form-control @if($errors->has('title')) is-invalid @endif @if($title !== null) is-valid @endif" placeholder="عنوان محصول">
                            <label for="floatingInput">عنوان محصول</label>
                            @error('title')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model="price" class="form-control @if($errors->has('price')) is-invalid @endif @if($price !== null) is-valid @endif" placeholder="قیمت">
                            <label for="floatingInput">قیمت</label>
                            @error('price')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        @if($price)
                            <label>
                                قیمت: {{number_format($price)}} تومان
                            </label>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model="discount" class="form-control @if($errors->has('discount')) is-invalid @endif @if($discount !== null) is-valid @endif" placeholder="قیمت تخفیف">
                            <label for="floatingInput">تخفیف</label>
                        </div>
                        @if($discount)
                            <label>
                                قیمت: {{number_format($discount)}} تومان
                            </label>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.debounce.1000ms="link" class="form-control @if($errors->has('link')) is-invalid @endif @if($link !== null) is-valid @endif" placeholder="لینک محصول">
                            <label for="floatingInput">لینک محصول</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="number" wire:model.debounce.1000ms="order_count" class="form-control @if($errors->has('order_count')) is-invalid @endif @if($order_count !== null) is-valid @endif" placeholder="تعداد سفارش محصول">
                            <label for="floatingInput">تعداد سفارش محصول</label>
                            @error('order_count')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <div wire:ignore>
                                <select wire:model.debounce.1000ms="category_id" id="categories" class=" @if($errors->has('category_id')) is-invalid @endif @if($category_id !== null) is-valid @endif">
                                    <option selected value="">انتخاب دسته بندی</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id === $category_id ? 'selected' : ''}}>{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <div>
                                <select wire:model.debounce.1000ms="sub_category_id" id="subCategories" class=" @if($errors->has('sub_category_id')) is-invalid @endif @if($sub_category_id !== null) is-valid @endif">
                                    <option selected value="">انتخاب زیر دسته بندی</option>
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{$subCategory->id}}" {{$subCategory->id === $sub_category_id ? 'selected' : ''}}>{{$subCategory->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('sub_category_id')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <div wire:ignore.self>
                                <select wire:model.debounce.1000ms="child_category_id" id="childCategories" class=" @if($errors->has('child_category_id')) is-invalid @endif @if($child_category_id !== null) is-valid @endif">
                                    <option selected value="">انتخاب دسته بندی کودک</option>
                                    @foreach($childCategories as $childCategory)
                                        <option value="{{$childCategory->id}}" {{$childCategory->id === $child_category_id ? 'selected' : ''}}>{{$childCategory->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('child_category_id')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <div wire:ignore>
                                <select wire:model.debounce.1000ms="brand_id" id="brands" class=" @if($errors->has('brand_id')) is-invalid @endif @if($brand_id !== null) is-valid @endif">
                                    <option selected value="">انتخاب برند</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}" {{$brand->id === $brand_id ? 'selected' : ''}}>
                                            {{$brand->title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('brand_id')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="number" wire:model.debounce.1000ms="stock" class="form-control @if($errors->has('stock')) is-invalid @endif @if($stock !== null) is-valid @endif" placeholder="تعداد موجودی محصول">
                            <label for="floatingInput">تعداد موجودی محصول</label>
                            @error('stock')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <input type="text" wire:model.debounce.1000ms="weight" class="form-control @if($errors->has('weight')) is-invalid @endif @if($weight !== null) is-valid @endif" placeholder="وزن محصول">
                            <label for="floatingInput">وزن محصول</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-floating mb-3">
                            <div wire:ignore>
                                <select wire:model.debounce.1000ms="type_of_quality" id="productQuality" class=" @if($errors->has('type_of_quality')) is-invalid @endif @if($type_of_quality !== null) is-valid @endif">
                                    <option selected value="">کیفیت محصول</option>
                                    @foreach(\App\Enums\ProductQuality::cases() as $item)
                                        <option value="{{$item->value}}" {{$item->value === $type_of_quality ? 'selected' : ''}}>{{__('enums.product-quality.'.$item->value)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('type_of_quality')
                            <div class="invalid-feedback" style="display: flex">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-5">
                        <input class="form-check-input " wire:model.defer="is_published" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            آیادرسایت نمایش داده شود؟
                        </label>
                    </div>
                    <div class="col-12 mb-5">
                        <input class="form-check-input " wire:model.defer="special" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            آیا محصول ویژه هست؟
                        </label>
                    </div>
                    <div class="col-12 mb-5">
                        <input class="form-check-input " wire:model.defer="gift" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            آیا محصول هدیه هست؟
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-5" wire:ignore>
                        <textarea class="form-control" rows="5" placeholder=" توضیحات کوتاه" id="short-description">
                            {!! $short_description !!}
                        </textarea>
                    </div>
                    <div class="col-12 mb-5" wire:ignore>
                        <textarea class="form-control" rows="5" placeholder=" توضیحات " id="description">
                            {!! $description !!}
                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="formFile" class="form-label">عکس شاخص</label>
                        <input class="form-control" type="file" wire:model.defer="image" id="formFile">
                        <div class="progress mt-2" wire:target="image" style="display: none" id="progressBar">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" wire:target="image" role="progressbar"></div>
                        </div>
                        @if($image)
                            <div class="img-thumbnail mb-3 mt-3">
                                <img class="img-fluid" src="{{$image->temporaryUrl()}}">
                            </div>
                        @else
                            @if($product->getFirstMediaUrl(__('messages.product.media-collection'),'thumb'))
                                <div class="img-thumbnail mb-3 mt-3">
                                    <img class="img-fluid" src="{{$product->getFirstMediaUrl(__('messages.product.media-collection'),'thumb')}}">
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <button type="submit" class="btn btn-brand" id="submit">اضافه کردن</button>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        ClassicEditor
            .create(document.querySelector('#short-description'), {
                language: 'fa',
            })
            .then(editor => {
                editor.ui.view.editable.element.style.height = '250px';
                editor.model.document.on('change:data', () => {
                    @this.
                    set('short_description', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#description'), {
                language: 'fa'
            })
            .then(editor => {
                editor.ui.view.editable.element.style.height = '250px';
                editor.model.document.on('change:data', () => {
                    @this.
                    set('description', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
        $('#categories').on('change', function () {
            let value = $(this).val();
            @this.
            set('category_id', value)
            livewire.emit('getSubCategories')
        })
        $('#subCategories').on('change', function () {
            let value = $(this).val();
            @this.
            set('sub_category_id', value)
            livewire.emit('getChildCategories')
        })
        $('#childCategories').on('change', function () {
            let value = $(this).val();
            @this.
            set('child_category_id', value)
        })
        $('#brands').on('change', function () {
            let value = $(this).val();
            @this.
            set('brand_id', value);
        })
        $('#productQuality').on('change', function () {
            let value = $(this).val();
            @this.
            set('type_of_quality', value);
        })
        window.addEventListener('hydrate', event => {
            $('div.dropdown-select').remove();
            create_custom_dropdowns();
        })
    </script>
@endpush

