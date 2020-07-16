$rules = [
@foreach($fields as $field)
   @if(!$field['primary'])
       "{{$field['name']}}" => [
        "required"
       ],
   @endif
@endforeach
];
$this->validate($request, $rules);
