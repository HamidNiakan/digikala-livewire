<tr role="row"  id="row{{$product->id}}">
    <td><a href="">{{$product->id}}</a></td>
    <td><img src="{{$product->getFirstMediaUrl('product-image','thumb')}}" width="100px"/></td>
    <td>{{$product->title}}</td>
    <td>{{$product->title_en}}</td>
    <td>{{$product->category->title ?? ''  }}</td>
    <td></td>
    <td>{{number_format($product->price)}}</td>
    <td>
        @if($product->status === \App\Enums\ProductStatus::Active)
            <span class="badge bg-success">
                فعال
            </span>
        @else
            <span class="badge bg-danger">
                غیرفعال
            </span>
        @endif
    </td>
    <td>
        <a wire:click.prevent="destroy" href="#" class="item-delete mlg-15" title="حذف"></a>
        <a wire:click.prevent="changeStatus" href="#" class=" {{$product->status = \App\Enums\ProductStatus::DeActive ? 'item-reject' : 'item-confirm'}}  mlg-15" title="{{$product->status = \App\Enums\ProductStatus::DeActive ? 'غیرفعال' : 'فعال'}}"></a>
        <a wire:click.prevent="edit" href="#" class="item-edit " title="ویرایش"></a>
    </td>
</tr>
