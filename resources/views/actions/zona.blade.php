<div class="d-flex justify-content-center align-items-center">
    <a class="btn btn-success btn-sm mr-1"
       target="_blank"
       href="{{getGoogleMap($value['zona_lat'], $value['zona_lng'])}}">
        <span class="fa fa-map-marker"></span>
        Buka Di Google Map
    </a>
    <a class="btn btn-primary btn-sm btn-edit mr-1" href="{{ route('zona.show', $value['zona_id']) }}">
        <span class="fa fa-pencil-alt"></span> Edit</a>
    <a class="btn btn-danger btn-sm btn-destroy" href="{{ route('zona.destroy', $value['zona_id']) }}"><span class="fa fa-trash"></span> Hapus</a>
</div>
