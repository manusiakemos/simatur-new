<div class="d-flex justify-content-center">
    <a class="btn btn-sm btn-primary btn-edit mr-1" href="{{ route('user.edit', $value['id']) }}">
        <span class="fa fa-pencil-alt"></span> Edit
    </a>
    <a class="btn btn-sm btn-danger btn-destroy" href="{{ route('user.destroy', $value['id']) }}">
        <span class="fa fa-trash"></span> Hapus
    </a>

</div>
