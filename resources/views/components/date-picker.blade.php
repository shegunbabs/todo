@props([
'format' => 'YYYY-MM-DD',
'yearHigh' => date("Y") - 10,
'yearLow' => date("Y") - 50,
'default' => ''
])
<button {{ $attributes }}
       x-data="{ model: @entangle($attributes->wire('model')) }"
       x-ref="input"
       x-init="new Pikaday({
                field: $refs.input,
                format: '{{$format}}',
                yearRange:[{{$yearLow}},{{$yearHigh}}],
                setDefaultDate: '{{$default}}' ? true : false,
                defaultDate: moment('{{$default}}').toDate(),
                onSelect: function(date){
                            $el.value = this.getMoment(date.toString()).format('{{$format}}');
                            model = $el.value;
                        },
            })"
>{{ $slot }}</button>
@once
    @push('scripts')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    @endpush

@endonce
