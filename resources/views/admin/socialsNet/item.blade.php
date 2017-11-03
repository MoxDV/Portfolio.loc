<tr>
    <td>
        {{ $social->title }}
    </td>
    <td>
        <i class="fa {{ $social->icon }}" style="width: 50px"></i>
    </td>

    <td>
        {{ $social->path }}
    </td>
    <td>
        @if($method === 'edit')
            <a href="{{ route('admin.soc-networks.edit',
                                                ['link' => $social->id]) }}"
               class="btn btn-primary">
                <i class="fa fa-pencil"></i>
            </a>
        @elseif($method === 'delete')
            {!! Form::open([
                    'route' => ['admin.soc-networks.destroy', $social->id],
                    'method'=> 'DELETE'
                ]) !!}
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-times"></i>
            </button>
            {!! Form::close() !!}
        @else
            {!! Form::open([
                'route' => ['admin.soc-networks.restore', $social->id],
            ]) !!}
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-arrow-up"></i>
            </button>
            {!! Form::close() !!}
        @endif
    </td>
</tr>