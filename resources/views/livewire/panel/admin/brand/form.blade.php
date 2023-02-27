<div>
    <p class="box__title">ایجاد برند جدید</p>
    <form wire:submit.prevent="submit" class="padding-20 needs-validation">
        <div class="form-floating mb-3">
            <input type="text" wire:model.debounce.1000ms="brand.title" class="form-control @if($errors->has('brand.title')) is-invalid @endif @if($brand->title !== null) is-valid @endif" placeholder="عنوان برند">
            <label for="floatingInput">عنوان برند</label>
            @error('brand.title')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror

        </div>
        <div class="form-floating mb-3">
            <div wire:ignore>
                <select wire:model.debounce.1000ms="brand.category_id" id="categories" class=" @if($errors->has('brand.category_id')) is-invalid @endif @if($brand->category_id !== null) is-valid @endif">
                    <option selected value="">انتخاب زیر دسته بندی</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('brand.category_id')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea rows="3" wire:model.debounce.1000ms="brand.description" class="form-control @if($errors->has('brand.description')) is-invalid @endif @if($brand->description !== null) is-valid @endif"></textarea>
            <label for="floatingInput">توضیحات</label>
        </div>
        <div class="form-check">
            <input class="form-check-input @if($errors->has('is_published')) is-invalid @endif @if($brand->is_published !== null) is-valid @endif" wire:model.defer="brand.is_published" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                آیادرسایت نمایش داده شود؟
            </label>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">آپلود ایکون</label>
            <input class="form-control" type="file" wire:model.defer="icon" id="formFile">
            <div class="progress mt-2" wire:target="icon" style="display: none" id="progressBar">
                <div class="progress-bar progress-bar-striped progress-bar-animated" wire:target="icon" role="progressbar"></div>
            </div>

            @error('icon')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror
        </div>
        @if($icon)
            <div class="img-thumbnail mb-3">
                <img class="img-fluid" src="{{$icon->temporaryUrl()}}">
            </div>
        @endif
        &nbsp;
        <button type="submit" class="btn btn-brand" id="submit">اضافه کردن</button>
    </form>
</div>
@push('scripts')
    <script>
        $('#categories').on('change', function () {
            let value = $(this).val();
            @this
        .
            set('brand.category_id', value)
        })
    </script>
@endpush
