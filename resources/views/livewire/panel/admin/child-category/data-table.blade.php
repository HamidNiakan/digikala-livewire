<tr role="row"  id="row{{$childCategory->id}}">
    <td><a href="">{{$childCategory->id}}</a></td>
    <td><img src="{{$childCategory->getFirstMediaUrl('childCategory-icon','thumb')}}" width="100px"/></td>
    <td><a href="">{{$childCategory->title}}</a></td>
    <td><a href="">{{$childCategory->slug}}</a></td>
    <td><a href="">{{$childCategory->subCategory ? $childCategory->subCategory->title : ''}}</a></td>
    <td>
        @if($childCategory->is_published)
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
        <a wire:click.prevent="changePublish" href="#" class=" {{$childCategory->is_published ? 'item-reject' : 'item-confirm'}}  mlg-15" title="{{$childCategory->is_published ? 'غیرفعال' : 'فعال'}}"></a>
        <a wire:click.prevent="edit" href="#" class="item-edit " title="ویرایش"></a>
    </td>
</tr>