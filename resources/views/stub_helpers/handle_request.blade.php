@foreach($fields as $field)
    @if($field['form_type'] == 'file' || $field['form_type'] == 'image')
        if($request->hasFile('file')){
            $filename = my_upload_file($request->file('file'));
            $db->{{$field['name']}} = $filename;
        }
    @else
        @if(!$field['primary'])
            $db->{{$field['name']}} = $request->{{$field['name']}};
        @endif
    @endif
@endforeach
