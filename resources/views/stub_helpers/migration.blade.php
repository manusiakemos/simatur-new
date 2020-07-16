@foreach($fields as $field)
    @if(isset($field['length']))
        @if($field['length'])
            $table->{{ $field['type'] }}('{{ $field['name'] }}' {!! $field['type'] != "integer" ? ",". $field['length'] : '' !!})
        @else
            $table->{{ $field['type'] }}('{{ $field['name'] }}')
        @endif
    @else
        $table->{{ $field['type'] }}('{{ $field['name'] }}')
    @endif
    @if($field['nullable'])
        ->nullable();
    @else
        ;
    @endif
@endforeach
