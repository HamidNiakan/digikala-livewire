<tr role="row"  id="row{{$activity->id}}">
    <td>{{$activity->id}}</td>
    <td>{{$activity->log_name}}</td>
    <td>{{$activity->event}}</td>
    <td>{{$activity->subject_type}}</td>
    <td>{{$activity->subject_id}}</td>
    <td></td>
    <td>{{$activity->description}}</td>
    <td>
        {{\Hekmatinasser\Verta\Verta::instance($activity->created_at)->format('%B %d، %Y')}}
    </td>
    <td>
    </td>
</tr>
