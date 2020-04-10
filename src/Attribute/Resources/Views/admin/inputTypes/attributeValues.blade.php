
@php
$values = null;
if( isset($item) ){
    $attribute = $item;
    $attributeValues = $attribute->{$field->name};  //here filed->name = values

}

@endphp

<div class="{{$field->col ?? 'col-12 col-md-12'}}">
    <br>
    <h3>@lang("$crud->name::panel.$field->display")</h3>
</div>

@foreach ($attributeValues as $attributeValue)

<div class="{{$field->col ?? 'col-12 col-md-4'}}">
    <div class="form-group">
        <input type="hidden"
         id= "values-{{$loop->index}}"
         name="values[{{$loop->index}}][id]"
         value="{{$attributeValue->id}}"
         class="form-control @error($field->name) is-invalid @enderror"
         >
    </div>
</div>
<div class="{{$field->col ?? 'col-12 col-md-4'}}">
    <div class="form-group">
        <input type="text"
         id= "values-{{$loop->index}}"
         name="values[{{$loop->index}}][value]"
         value="{{$attributeValue->value}}"
         class="form-control @error($field->name) is-invalid @enderror"
         >
    </div>
</div>

<div class="{{$field->col ?? 'col-12 col-md-4'}}">
    <div class="form-group">
         <input type="text"
         id= "values-{{$loop->index}}"
         name="values[{{$loop->index}}][position]"
         value="{{$loop->index}}"
         class="form-control @error($field->name) is-invalid @enderror"
         >
    </div>
</div>

@endforeach

<div class="{{$field->col ?? 'col-12 col-md-4'}}">
    <div class="form-group">
        <input type="text"
         id= "values-{{$loop->index + 1}}"
         name="values[{{$loop->index}}][id]"
         value=""
         class="form-control @error($field->name) is-invalid @enderror"
         >
    </div>
</div>
<div class="{{$field->col ?? 'col-12 col-md-4'}}">
    <div class="form-group">
        <input type="text"
         id= "values-{{$loop->index}}"
         name="values[{{$loop->index}}][value]"
         value=""
         class="form-control @error($field->name) is-invalid @enderror"
         >
    </div>
</div>

<div class="{{$field->col ?? 'col-12 col-md-4'}}">
    <div class="form-group">
         <input type="text"
         id= "values-{{$loop->index}}"
         name="values[{{$loop->index}}][position]"
         value=""
         class="form-control @error($field->name) is-invalid @enderror"
         >
    </div>
</div>