<tr role="row"  id="row{{$brand->id}}">
    <td><a href="">{{$brand->id}}</a></td>
    <td><img src="{{$brand->getFirstMediaUrl(__('messages.brand.media-collection'),'thumb')}}" width="100px"/></td>
    <td>{{$brand->title}}</td>
    <td>
        @if($brand->is_published)
            <span class="badge bg-success">
                منتشر
            </span>
        @else
            <span class="badge bg-danger">
                مخغی
            </span>
        @endif
    </td>
    <td>
        <a wire:click.prevent="destroy" href="#" class="item-delete mlg-15" title="حذف"></a>
        <a wire:click.prevent="changePublish" href="#" class=" {{$brand->is_published ? 'item-reject' : 'item-confirm'}}  mlg-15" title="{{$brand->is_published ? 'غیرفعال' : 'فعال'}}"></a>
        <a wire:click.prevent="edit" href="#" class="item-edit " title="ویرایش"></a>
    </td>
</tr>
