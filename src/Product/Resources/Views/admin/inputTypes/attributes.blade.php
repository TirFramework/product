@php
    use Illuminate\Support\Arr;
    use Tir\Store\Attribute\Entities\AttributeSet;
       //generate empty object for handel create page
        $productAttributes = (object)[null];

        //get all attribute from Attribute model
        $attributeSets = AttributeSet::with('attributes')->get()->sortBy('name');
        $old = old('attributes');


        if( isset($item->attributes) || isset($old)){
            if(isset($item->attributes)){
                if(count($item->attributes) > 0){
                $edit = true;
                $product = $item;
                //get product attributes
                $productAttributes =  $product->attributes;
                }
            }

            if($old){
                $productAttributes = json_decode(json_encode($old));
            }

            $productAttributeIds = Arr::pluck($productAttributes, 'attribute_id');
            $productAttributesAllValues = \Tir\Store\Attribute\Entities\AttributeValue::whereIn('attribute_id',$productAttributeIds)->get();
        }



@endphp

<div class="col-12">
    <div class="row sortable-header">
        <div class="col-md-4 col-xs-12 ">
            <label> @lang("$crud->name::panel.name") </label>
        </div>
    </div>
</div>


<div class="col-12">

    <div class="cloning sortable">

        @foreach ($productAttributes as $productAttribute)
            <div class="item">
                <div class="row">

                    <div class="col-md-6 col-12 form-group">
                        <select id="attributes-{{$loop->index}}-attribute_id" id-template="attributes-xxx-attribute_id"
                                required
                                name-template="attributes[xxx][attribute_id]"
                                name="attributes[{{$loop->index}}][attribute_id]"
                                class="form-control attributes select2 @error(" attributes[{{$loop->index}}][attribute_id]")
                                        is-invalid @enderror">
                            <option value="" disabled selected>@lang("$crud->name::panel.select")</option>
                            @foreach($attributeSets as $attributeSet)
                                <optgroup label="{{$attributeSet->name}}">
                                    @foreach($attributeSet->attributes as $attribute)
                                        <option value="{{$attribute->id}}"
                                                @if(isset($edit) || isset($old))
                                                    @if($productAttribute->attribute_id == $attribute->id) selected @endif
                                                @endif
                                        >
                                            {{$attribute->name}}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <span class="invalid-feedback" role="alert">
                            @error("attributes[{{$loop->index}}][attribute_id]")
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>

                    @if(isset($edit) || isset($old))
                        @php
                            //get all values of specific attribute of product in foreach
                            // we use this values for show selected option is select box
                            // in old situation we have only ids of selected item but in
                            // edit situation we have id and value of selected item so
                            // we need to take only id, we use

                            if(isset($old)){
                                $selectedValues = $productAttribute->values;
                            }else{    //isset just edit
                                $selectedValues = $productAttribute->values->pluck('id')->toArray();
                            }
                            $thisAttributeValues = $productAttributesAllValues->where('attribute_id',$productAttribute->attribute_id );
                        @endphp
                    @endif


                    <div class="col-md-6 col-12 form-group">
                        <select @if(!isset($edit)) disabled @endif id="attributes-{{$loop->index}}-values" id-template="attributes-xxx-values" required
                                name-template="attributes[xxx][values][]" name="attributes[{{$loop->index}}][values][]"
                                class="form-control values taggable select2 @error(" attributes[{{$loop->index}}][values]")
                                        is-invalid @enderror" multiple>
                            @if(isset($edit) || isset($old))
                                @foreach($thisAttributeValues as $attributeValue)
                                    <option value="{{$attributeValue->id}}"
                                            @if(in_array($attributeValue->id,$selectedValues)) selected @endif>
                                        {{$attributeValue->value}}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <span class="invalid-feedback" role="alert">
                            @error("attributes[{{$loop->index}}][values]")
                            <strong>{{ $message }}</strong>
                            @enderror
                        </span>
                    </div>


                </div>
            </div>
        @endforeach
    </div>

</div>




@push('firstScripts')
<script>

    let field = new additionalField('.cloning');

    field.callback = function () {


       $("#attributes-" + field.dataId + "-attribute_id").select2();

        taggable();

    };


    //AJAX for get value
    $(".cloning").on('change', '.attributes', function () {
        var $this = $(this);
        var selectedAttribute = $(this).find(":selected").val();

        $.ajax({
            url: "/admin/attribute/" + selectedAttribute + "/values/",
            method: 'GET',
            dataType: 'json',

            success: function (values) {

                var valuesSelect = $this.parents('.item').find('.values');

                valuesSelect.attr('disabled',false)
                valuesSelect.find('option').remove();

                // create the option and append to Select2
                $.each(values, function (id, value) {
                    option = new Option(value.value, value.id, true, false);
                    valuesSelect.append(option).trigger('change');
                });

                //manually trigger the `select2:select` event
                valuesSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: values
                    }
                });

            }
        });

    });
</script>
@endpush

@push('scripts')
    <script>

        function taggable(){

            console.log('taggable');
            $(".select2.taggable").select2({
                tags: true,
                createTag: function (params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }
                    return {
                        id: term,
                        text: term,
                        newTag: true // add additional parameters
                    }
                },

                insertTag: function (data, tag) {
                    // Insert the tag at the end of the results
                    data.push(tag);
                }

            });
            $('.select2.taggable').on('select2:select', function (e) {
                var data = e.params.data;
                var attributeId = $(this).parents('.item').find('.attributes').find(":selected").val();
                var confirm = false;
                var newValue = null;
                var $thisSelect = $(this);


                if(data.newTag === true)
                {
                    newValue = data.id;
                    Swal.fire({
                        title: '@lang("$crud->name::panel.create_new_value")',
                        text: '@lang("$crud->name::panel.do_want_to_create_new_value_for_this_attribute?")',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: '@lang("$crud->name::panel.cancel")',
                        confirmButtonText: '@lang("$crud->name::panel.yes_do_it")'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: "/admin/attributeValue",
                                type: 'post',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },

                                data: {
                                    requestType: 'ajax',
                                    'value': data.text,
                                    'attribute_id': attributeId,
                                    'position': 0
                                },

                                success: function (data) {
                                    console.log(newValue);
                                    $thisSelect.find('[value="'+ newValue +'"]').val(data.item.id);

                                    Swal.fire({
                                        title: '@lang("$crud->name::panel.operation_was_successful")',
                                        text: '@lang("$crud->name::panel.new_value_add_successfully")',
                                        confirmButtonText: '@lang("$crud->name::panel.ok")',
                                        confirmButtonColor: '#1ca700',

                                    });
                                }
                            });

                        }
                    });




                }
            });

        }

        taggable();

    </script>

@endpush