<div class="d-flex justify-content-center align-items-center">
    <a class="btn btn-primary btn-sm btn-edit mr-1" href="{{ route('item.show', $value['id']) }}">
        <span class="fa fa-pencil-alt"></span> Edit</a>
    <a class="btn btn-danger btn-sm btn-destroy" href="{{ route('item.destroy', $value['id']) }}"><span class="fa fa-trash"></span> Hapus</a>
</div>
