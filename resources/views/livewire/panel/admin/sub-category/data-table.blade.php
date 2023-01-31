<tr role="row"  id="row{{$subCategory->id}}">
    <td><a href="">{{$subCategory->id}}</a></td>
    <td><img src="{{$subCategory->getFirstMediaUrl('subCategory-icon','thumb')}}" width="100px"/></td>
    <td><a href="">{{$subCategory->title}}</a></td>
    <td><a href="">{{$subCategory->slug}}</a></td>
    <td><a href="">{{$subCategory->category ? $subCategory->category->title : ''}}</a></td>
    <td>
        @if($subCategory->is_published)
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
        <a wire:click.prevent="changePublish" href="#" class=" {{$subCategory->is_published ? 'item-reject' : 'item-confirm'}}  mlg-15" title="{{$subCategory->is_published ? 'غیرفعال' : 'فعال'}}"></a>
        <a wire:click.prevent="edit" href="#" class="item-edit " title="ویرایش"></a>
    </td>
</tr>
