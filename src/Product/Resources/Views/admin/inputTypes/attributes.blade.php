@php
    use Illuminate\Support\Arr;
    use Tir\Store\Attribute\Entities\AttributeSet;

       //generate empty object for handel create page
        $productAttributes = (object)[null];

        //get all attribute from Attribute model
        $attributeSets = AttributeSet::with('attributes')->get()->sortBy('name');
        $old = old('attributes');


        if( isset($item) || isset($old)){

            if(isset($item)){
                $edit = true;
                $product = $item;
                //get product attributes
                $productAttributes =  $product->attributes;
            }

            if($old){
                $productAttributes = json_decode(json_encode($old));
            }

            $productAttributeIds = Arr::pluck($productAttributes, 'attribute_id');
            $productAttributesAllValues = \Tir\Store\Attribute\Entities\AttributeValue::whereIn('attribute_id',$productAttributeIds)->get();
        }



@endphp

<div class="cloning sortable">

    <div class="row labels">
        <div class="col-md-4 col-xs-12 ">
            <label> @lang("$crud->name::panel.name") </label>
        </div>
    </div>


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
                    <select id="attributes-{{$loop->index}}-values" id-template="attributes-xxx-values" required
                            name-template="attributes[xxx][values][]" name="attributes[{{$loop->index}}][values][]"
                            class="form-control values select2 @error(" attributes[{{$loop->index}}][values]")
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



@push('firstScripts')
    <script>
        var $cloning,
            $item,
            templateHtml,
            dataId;

        function runCloning() {
            $cloning = $('.cloning');
            $item = $cloning.find('.item');

            $(".cloning").after(`<a class="plus btn"><i class="fas fa-plus"></i></a>`);

            dataId = $item.length - 1;


            $item.each(function (index) {

                templateHtml = $(this).html();

                $(this).remove();
                var newItem = $('<div class="item"></div>');

                $(newItem).append(`<a class="remove-item btn"><i class="fas fa-times"></i></a> ${templateHtml} `);

                $(newItem).find('[name]').each(function () {

                    var nameTemplate = $(this).attr('name-template');
                    $(this).removeAttr('name-template');
                    newName = replaceAll(nameTemplate, 'xxx', dataId);
                    $(this).attr('name', newName);


                });


                $(newItem).find('[id]').each(function () {

                    var idTemplate = $(this).attr('id-template');
                    $(this).removeAttr('id-template');
                    idName = replaceAll(idTemplate, 'xxx', dataId);
                    $(this).attr('id', idName);

                });

                $('.cloning').append(newItem);
                dataId++;
            });
        }


        runCloning();

        function addRow() {

            var newItem = $('<div class="item"></div>');
            $(newItem).append(`<a class="remove-item btn"><i class="fas fa-times"></i></a> ${templateHtml} `);

            $(newItem).find('[name]').each(function () {
                var nameTemplate = $(this).attr('name-template');
                $(this).removeAttr('name-template');
                newName = replaceAll(nameTemplate, 'xxx', dataId);
                $(this).attr('name', newName);
                $(this).val('');
            });


            $(newItem).find('[id]').each(function () {
                var idTemplate = $(this).attr('id-template');
                $(this).removeAttr('id-template');
                idName = replaceAll(idTemplate, 'xxx', dataId);
                $(this).attr('id', idName);
            });


            $('.cloning').append(newItem);
            dataId++;
        }


        $('.cloning').on("click", 'a.remove-item', function (e) {
            e.preventDefault();
            $(this).parents('.item').remove();
        });

        $('body').on("click", 'a.plus', function () {
            addRow();
            $(".select2").select2();

        });


        $(function () {
            $(".sortable").sortable();
            $(".sortable").disableSelection();
        });


        function replaceAll(str, find, replace) {
            return str.replace(new RegExp(find, 'g'), replace);
        }


        $(".cloning").on('change', '.attributes', function () {
            var $this = $(this);
            var selectedAttribute = $(this).children("option:selected").val();

            $.ajax({
                url: "/admin/attribute/" + selectedAttribute + "/values/",
                method: 'GET',
                dataType: 'json',

                success: function (values) {
                    //console.log(data);
                    //$('#city').html(data.html);
                    // console.log("data.value", data[0].value)


                    var valuesSelect = $this.parents('.item').find('.values');
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




