<div class="d-flex justify-content-center align-items-center">
    <a target="_blank" class="btn btn-success btn-sm mr-1" href="{{$value['google_map']}}">
        <span class="fa fa-map-marked"></span> Google Map</a>
    <a class="btn btn-primary btn-sm btn-edit mr-1" href="{{ route('permohonan.show', $value['p_id']) }}">
        <span class="fa fa-pencil-alt"></span> Edit</a>
    <a class="btn btn-danger btn-sm btn-destroy mr-1" href="{{ route('permohonan.destroy', $value['p_id']) }}"><span
            class="fa fa-trash"></span> Hapus</a>
    <a class="btn btn-info btn-sm" href="{{ route('permohonan.download', $value['p_id']) }}"><span
            class="fa fa-file-archive"></span> Download File</a>
</div>
