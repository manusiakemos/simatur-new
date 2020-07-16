<div class="d-flex justify-content-center align-items-center">
    <a class="btn btn-primary btn-sm btn-detail mr-1" href="{{ url("admin#/mainapp/towerprovider/{$value['tower_id']}") }}">
        <span class="fa fa-list-ol"></span> Provider</a>
    <a class="btn btn-primary btn-sm btn-edit mr-1" href="{{ route('tower.show', $value['tower_id']) }}">
        <span class="fa fa-pencil-alt"></span> Edit</a>
    <a class="btn btn-danger btn-sm btn-destroy" href="{{ route('tower.destroy', $value['tower_id']) }}"><span class="fa fa-trash"></span> Hapus</a>
</div>
