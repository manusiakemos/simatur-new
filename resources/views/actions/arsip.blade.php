<div class="d-flex justify-content-center align-items-center">
    <a class="btn btn-primary btn-sm btn-edit mr-1" href="{{ route('arsip.show', $value['arsip_id']) }}">
        <span class="fa fa-pencil-alt"></span> Edit</a>
    <a class="btn btn-danger btn-sm btn-destroy" href="{{ route('arsip.destroy', $value['arsip_id']) }}"><span class="fa fa-trash"></span> Hapus</a>
</div>
