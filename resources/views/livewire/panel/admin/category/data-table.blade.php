<tr role="row"  id="row{{$category->id}}">
    <td><a href="">{{$category->id}}</a></td>
    <td><img src="{{$category->getFirstMediaUrl('category-icon','thumb')}}" width="100px"/></td>
    <td><a href="">{{$category->title}}</a></td>
    <td><a href="">{{$category->slug}}</a></td>
    <td>
        @if($category->is_published)
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
        <a wire:click.prevent="changePublish" href="#" class=" {{$category->is_published ? 'item-reject' : 'item-confirm'}}  mlg-15" title="{{$category->is_published ? 'غیرفعال' : 'فعال'}}"></a>
        <a href="" class="item-lock mlg-15" title="قفل دوره"></a>
        <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
        <a href="" class="item-edit " title="ویرایش"></a>
    </td>
</tr>