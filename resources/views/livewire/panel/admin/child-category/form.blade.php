<div>
    <p class="box__title">ایجاد دسته بندی کودک جدید</p>
    <form wire:submit.prevent="submit" class="padding-20 needs-validation">
        <div class="form-floating mb-3">
            <input type="text" wire:model.debounce.1000ms="childCategory.title" class="form-control @if($errors->has('childCategory.title')) is-invalid @endif @if($childCategory->title !== null) is-valid @endif" placeholder="نام دسته بندی کودک">
            <label for="floatingInput">نام دسته بندی کودک</label>
            @error('childCategory.title')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror

        </div>
        <div class="form-floating mb-3">
            <input type="text" wire:model.debounce.1000ms="childCategory.slug" class="form-control @if($errors->has('childCategory.slug')) is-invalid @endif @if($childCategory->slug !== null) is-valid @endif" placeholder="نام انگلیسی دسته بندی کودک">
            <label for="floatingInput">نام انگلیسی دسته بندی کودک</label>
            @error('childCategory.slug')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="text" wire:model.debounce.1000ms="childCategory.link" class="form-control @if($errors->has('childCategory.link')) is-invalid @endif @if($childCategory->link !== null) is-valid @endif" placeholder="لینک دسته بندی کودک">
            <label for="floatingInput">لینک دسته بندی کودک </label>
            @error('childCategory.link')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <div wire:ignore>
                <select wire:model.debounce.1000ms="childCategory.sub_category_id" id="subCategories" class=" @if($errors->has('childCategory.sub_category_id')) is-invalid @endif @if($childCategory->sub_category_id !== null) is-valid @endif">
                    <option selected  value="">انتخاب زیر دسته بندی</option>
                    @foreach($subcategories as $subCategory)
                        <option value="{{$subCategory->id}}">{{$subCategory->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('childCategory.sub_category_id')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-check">
            <input class="form-check-input @if($errors->has('is_published')) is-invalid @endif @if($childCategory->is_published !== null) is-valid @endif" wire:model.defer="childCategory.is_published" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                آیادرسایت نمایش داده شود؟
            </label>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">آپلود ایکون</label>
            <input class="form-control" type="file" wire:model.defer="icon" id="formFile">
            <div class="progress mt-2" wire:target="icon"  style="display: none" id="progressBar">
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
        $('#subCategories').on('change',function () {
            let value = $(this).val();
            @this
        .set('childCategory.sub_category_id',value)
        })
    </script>
@endpush