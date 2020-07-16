@foreach($fields as $field)
    @if($field['primary'] == false)
        <b-form-group
            label="{!! $field['text'] !!}"
            label-for="{!! $field['name'] !!}"
            :invalid-feedback="this.errors && this.errors.{!! $field['name'] !!} ? this.errors.{!! $field['name'] !!}.join() : ''"
            :state="this.errors && this.errors.{!! $field['name'] !!} ? false : true"
        >
            @if($field['form_type'] == "text")
                <b-form-input id="{!! $field['name'] !!}"
                              v-model="data.{!! $field['name'] !!}"
                ></b-form-input>
            @elseif($field['form_type'] == 'radio')
                <radio-ajax v-model="data.{!! $field['name'] !!}"
                              api-url="/api/select/status"
                              option-text="text"
                              option-value="value">
                </radio-ajax>
            @elseif($field['form_type'] == 'money')
                <my-money id="{!! $field['name'] !!}"
                          v-model="data.{!! $field['name'] !!}"
                ></my-money>
            @elseif($field['form_type'] == 'file')
                <b-form-file v-model="file"></b-form-file>
            @elseif($field['form_type'] == 'image')
                <b-form-file v-model="file" accept="image/*"></b-form-file>
            @elseif($field['form_type'] == 'select')
                <select-ajax id="{!! $field['name'] !!}"
                             api-url="/api/select/status"
                             option-text="text"
                             option-value="value"
                             v-model="data.{!! $field['name'] !!}"
                ></select-ajax>
            @elseif($field['form_type'] == 'date')
                <my-date-picker type="date" id="{!! $field['name'] !!}"
                                format="YYYY-MM-DD"
                                v-model="data.{!! $field['name'] !!}"
                ></my-date-picker>
            @elseif($field['form_type'] == 'time')
                <my-date-picker type="time" id="{!! $field['name'] !!}"
                                format="HH-mm-ss"
                                v-model="data.{!! $field['name'] !!}"
                ></my-date-picker>
            @elseif($field['form_type'] == 'year')
                <my-date-picker type="year" id="{!! $field['name'] !!}"
                                format="YYYY"
                                v-model="data.{!! $field['name'] !!}"
                ></my-date-picker>
            @elseif($field['form_type'] == 'month')
                <my-date-picker type="month" id="{!! $field['name'] !!}"
                                format="MM"
                                v-model="data.{!! $field['name'] !!}"
                ></my-date-picker>
            @elseif($field['form_type'] == 'datetime')
                <my-date-picker type="datetime" id="{!! $field['name'] !!}"
                                v-model="data.{!! $field['name'] !!}"
                ></my-date-picker>
            @endif
        </b-form-group>
    @endif
@endforeach
