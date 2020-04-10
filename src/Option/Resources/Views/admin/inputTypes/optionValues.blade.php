
@php
$values = null;
$optionValues = [];
if( isset($item) ){
    $option = $item;

    $optionValues = isset($option->{$field->name}) ? $option->{$field->name} : [] ;  //here filed->name = values

}
@endphp

<div class="{{$field->col ?? 'col-12 col-md-12'}}">
    <br>
    <h3>@lang("$crud->name::panel.$field->display")</h3>
</div>

@foreach ($optionValues as $optionValue)

    <input type="hidden"
     id= "values-id-{{$loop->index}}"
     name="values[{{$loop->index}}][id]"
     value="{{$optionValue->id}}"
     class="form-control @error($field->name) is-invalid @enderror" >


    <div class="{{$field->col ?? 'col-12 col-md-3'}}">
        <div class="form-group">
            <input type="text"
             id= "value-label-{{$loop->index}}"
             name="values[{{$loop->index}}][label]"
             value="{{ $optionValue->label }}"
             class="form-control @error("values[{{$loop->index}}][label]") is-invalid @enderror"
             >
            <span class="invalid-feedback" role="alert">
                    @error("values[{{$loop->index}}][label]")
                    <strong>{{ $message }}</strong>
                    @enderror
                </span>
            <label for="value-label-{{$loop->index}}" class="control-label text-right">@lang("$crud->name::panel.label")</label>
        </div>
    </div>

    <div class="{{$field->col ?? 'col-12 col-md-3'}}">
        <div class="form-group">
            <input type="text"
                   id= "value-price-{{$loop->index}}"
                   name="values[{{$loop->index}}][price]"
                   value="{{$optionValue->price}}"
                   class="form-control @error($field->name) is-invalid @enderror"
            >
            <span class="invalid-feedback" role="alert">
                    @error("values[{{$loop->index}}][price]")
                    <strong>{{ $message }}</strong>
                    @enderror
                </span>
            <label for="value-price-{{$loop->index}}" class="control-label text-right">@lang("$crud->name::panel.price")</label>
        </div>

    </div>

    <div class="{{$field->col ?? 'col-12 col-md-3'}}">
        <div class="form-group">
            <select name="values[{{$loop->index}}][price_type]"
                    id="value-price-type-{{$loop->index}}"
                    class="form-control @error("values[{{$loop->index}}][price_type]") is-invalid @enderror">
                <option value="fixed" @if($optionValue->pricet_type == 'fixed') selected="selected" @endif >@lang("$crud->name::panel.fixed")</option>
                <option value="percent" @if($optionValue->price_type == 'percent') selected="selected" @endif >@lang("$crud->name::panel.percent")</option>
            </select>

            <span class="invalid-feedback" role="alert">
                    @error("values[{{$loop->index}}][price_type]")
                    <strong>{{ $message }}</strong>
                    @enderror
                </span>
            <label for="value-price-type-{{$loop->index}}" class="control-label text-right">@lang("$crud->name::panel.price_type")</label>
        </div>
    </div>

    <div class="{{$field->col ?? 'col-12 col-md-3'}}">
        <div class="form-group">
            <input type="text"
                   id= "value-label-{{$loop->index}}"
                   name="values[{{$loop->index}}][position]"
                   value="{{$optionValue->position}}"
                   class="form-control @error($field->name) is-invalid @enderror">

            <span class="invalid-feedback" role="alert">
                @error("value[{{$loop->index}}][position]")
                <strong>{{ $message }}</strong>
                @enderror
            </span>
            <label for="value-price-{{$loop->index}}" class="control-label text-right">@lang("$crud->name::panel.position")</label>
        </div>
    </div>
@endforeach

<input type="hidden"
       id= "values-id-{{$loop->index}}"
       name="values[{{$loop->index}}][id]"
       value=""
       class="form-control @error($field->name) is-invalid @enderror" >


<div class="{{$field->col ?? 'col-12 col-md-3'}}">
    <div class="form-group">
        <input type="text"
               id= "value-label-{{$loop->index}}"
               name="values[{{$loop->index}}][label]"
               value=""
               class="form-control @error("values[{{$loop->index}}][label]") is-invalid @enderror"
        >
        <span class="invalid-feedback" role="alert">
                    @error("values[{{$loop->index}}][label]")
                    <strong>{{ $message }}</strong>
                    @enderror
                </span>
        <label for="value-label-{{$loop->index}}" class="control-label text-right">@lang("$crud->name::panel.label")</label>
    </div>
</div>

<div class="{{$field->col ?? 'col-12 col-md-3'}}">
    <div class="form-group">
        <input type="text"
               id= "value-price-{{$loop->index}}"
               name="values[{{$loop->index}}][price]"
               value=""
               class="form-control @error($field->name) is-invalid @enderror"
        >
        <span class="invalid-feedback" role="alert">
                    @error("values[{{$loop->index}}][price]")
                    <strong>{{ $message }}</strong>
                    @enderror
                </span>
        <label for="value-price-{{$loop->index}}" class="control-label text-right">@lang("$crud->name::panel.price")</label>
    </div>

</div>

<div class="{{$field->col ?? 'col-12 col-md-3'}}">
    <div class="form-group">
        <select name="values[{{$loop->index}}][price_type]"
                id="value-price-type-{{$loop->index}}"
                class="form-control @error("values[{{$loop->index}}][price_type]") is-invalid @enderror">
            <option value="fixed" @if($optionValue->pricet_type == 'fixed') selected="selected" @endif >@lang("$crud->name::panel.fixed")</option>
            <option value="percent" @if($optionValue->price_type == 'percent') selected="selected" @endif >@lang("$crud->name::panel.percent")</option>
        </select>

        <span class="invalid-feedback" role="alert">
                    @error("values[{{$loop->index}}][price_type]")
                    <strong>{{ $message }}</strong>
                    @enderror
                </span>
        <label for="value-price-type-{{$loop->index}}" class="control-label text-right">@lang("$crud->name::panel.price_type")</label>
    </div>
</div>

<div class="{{$field->col ?? 'col-12 col-md-3'}}">
    <div class="form-group">
        <input type="text"
               id= "value-label-{{$loop->index}}"
               name="values[{{$loop->index}}][position]"
               value=""
               class="form-control @error($field->name) is-invalid @enderror">

        <span class="invalid-feedback" role="alert">
                @error("value[{{$loop->index}}][position]")
                <strong>{{ $message }}</strong>
                @enderror
            </span>
        <label for="value-price-{{$loop->index}}" class="control-label text-right">@lang("$crud->name::panel.position")</label>
    </div>
</div>

