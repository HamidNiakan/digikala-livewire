<div>
    @section('title','ویرایش دسته بندی')
    <div class="main-content padding-0">
        <p class="box__title">ویرایش دسته بندی : {{$category->title}}</p>
        <div class="col-12 bg-white padding-0">
            <form wire:submit.prevent="update" class="padding-20 needs-validation">
                <div class="form-floating mb-3">
                    <input type="text" wire:model.debounce.1000ms="category.title" value="{{$category->title}}" class="form-control @if($errors->has('category.title')) is-invalid @endif @if($category->title !== null) is-valid @endif" placeholder="نام دسته بندی">
                    <label for="floatingInput">نام دسته بندی</label>
                    @error('category.title')
                    <div class="invalid-feedback" style="display: flex">
                        {{$message}}
                    </div>
                    @enderror

                </div>
                <div class="form-floating mb-3">
                    <input type="text" wire:model.debounce.1000ms="category.slug" class="form-control @if($errors->has('category.slug')) is-invalid @endif @if($category->slug !== null) is-valid @endif" placeholder="نام انگلیسی دسته بندی">
                    <label for="floatingInput">نام انگلیسی دسته بندی</label>
                    @error('category.slug')
                    <div class="invalid-feedback" style="display: flex">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" wire:model.debounce.1000ms="category.link" class="form-control @if($errors->has('category.link')) is-invalid @endif @if($category->link !== null) is-valid @endif" placeholder="لینک دسته بندی">
                    <label for="floatingInput">لینک دسته بندی</label>
                    @error('category.link')
                    <div class="invalid-feedback" style="display: flex">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-check">
                    <input class="form-check-input @if($errors->has('icon')) is-invalid @endif @if($category->icon !== null) is-valid @endif" wire:model.defer="category.is_published" type="checkbox" value="" id="flexCheckDefault">
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
                @else
                    @if($category->getFirstMediaUrl('category-icon','thumb'))
                        <div class="img-thumbnail mb-3">
                            <img class="img-fluid" src="{{$category->getFirstMediaUrl('category-icon','thumb')}}">
                        </div>
                    @endif
                @endif
                &nbsp;
                <button type="submit" class="btn btn-brand" id="submit">اضافه کردن</button>
            </form>
        </div>
    </div>

</div>
