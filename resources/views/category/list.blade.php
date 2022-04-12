<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>Owner</th>
        <th>Controls</th>
        <th>Created</th>
    </tr>
    </thead>
    <tbody>
    @forelse(\App\Category::with('user')->get() as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td>{{ $c->title }}</td>
            <td>{{ $c->user->name }}</td>
            <td>
                <form action="{{ route("category.destroy",$c->id) }}" id="form{{ $c->id }}" method="post" class="d-inline-block">
                    @csrf
                    @method("delete")
                    <button type="button" class="btn btn-outline-danger" onclick="askConfirm({{ $c->id }})"><i class="feather-trash"></i> Delete</button>
                </form>
                <a href="{{ route("category.edit",$c->id) }}" class="btn btn-outline-primary"><i class="feather-edit"></i> Edit</a>
            </td>
            <td>
                <span class="small">
                    <i class="feather-calendar"></i>
                    {{ $c->created_at->format("d-m-Y") }}
                </span>
                <br>
                <span class="small">
                    <i class="feather-clock"></i>
                    {{ $c->created_at->format("h:i A") }}
                </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">There is no category</td>
        </tr>
    @endforelse
    </tbody>
</table>
