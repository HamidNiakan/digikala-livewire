<tr role="row"  id="row{{$product->id}}">
    <td>
        <a href="">{{$product->id}}</a>
    </td>
    <td>
        {{$product->code}}
    </td>
    <td>
        <img src="{{$product->getFirstMediaUrl('product-image','thumb')}}" width="100px"/>
    </td>
    <td>{{$product->title}}</td>
    <td>
        <ul>
            <li>{{$product->category ? $product->category->title : ''}}</li>
            <li>&nbsp;{{$product->subCategory ? $product->subCategory->title : ''}}</li>
            <li>&nbsp;&nbsp;{{$product->childCategory ? $product->childCategory->title : ''}}</li>
        </ul>
    </td>
    <td>
        {{$product->brand->title}}
    </td>
    <td>{{number_format($product->price)}}  تومان </td>
    <td>{{number_format($product->discount)}}تومان </td>
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
        <a wire:click.prevent="destroy" href="#" class="item-delete mlg-15" title="حذف"></a>
        <a wire:click.prevent="changePublish" href="#" class=" {{$product->is_published ? 'item-reject' : 'item-confirm'}}  mlg-15" title="{{$product->is_published ? 'غیرفعال' : 'فعال'}}"></a>
        <a wire:click.prevent="edit" href="#" class="item-edit " title="ویرایش"></a>
    </td>
</tr>
