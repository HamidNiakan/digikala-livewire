<div>
    <p class="box__title">ایجاد زیر دسته بندی جدید</p>
    <form wire:submit.prevent="submit" class="padding-20 needs-validation">
        <div class="form-floating mb-3">
            <input type="text" wire:model.debounce.1000ms="subCategory.title" class="form-control @if($errors->has('subCategory.title')) is-invalid @endif @if($subCategory->title !== null) is-valid @endif" placeholder="نام زیر دسته بندی">
            <label for="floatingInput">نام زیر دسته بندی</label>
            @error('subCategory.title')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror

        </div>
        <div class="form-floating mb-3">
            <input type="text" wire:model.debounce.1000ms="subCategory.slug" class="form-control @if($errors->has('subCategory.slug')) is-invalid @endif @if($subCategory->slug !== null) is-valid @endif" placeholder="نام انگلیسی زیر دسته بندی">
            <label for="floatingInput">نام انگلیسی زیر دسته بندی</label>
            @error('subCategory.slug')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <input type="text" wire:model.debounce.1000ms="subCategory.link" class="form-control @if($errors->has('subCategory.link')) is-invalid @endif @if($subCategory->link !== null) is-valid @endif" placeholder="لینک زیر دسته بندی">
            <label for="floatingInput">لینک زیردسته بندی</label>
            @error('subCategory.link')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <div wire:ignore>
                <select wire:model.debounce.1000ms="subCategory.category_id" id="categories" class=" @if($errors->has('subCategory.category_id')) is-invalid @endif @if($subCategory->category_id !== null) is-valid @endif">
                    <option selected  value="">انتخاب دسته بندی</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            </div>
            @error('subCategory.category_id')
            <div class="invalid-feedback" style="display: flex">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-check">
            <input class="form-check-input @if($errors->has('is_published')) is-invalid @endif @if($subCategory->is_published !== null) is-valid @endif" wire:model.defer="subCategory.is_published" type="checkbox" value="" id="flexCheckDefault">
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
        $('#categories').on('change',function () {
            let value = $(this).val();
            @this
            .set('subCategory.category_id',value)
        })
    </script>
@endpush
