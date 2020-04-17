@php
$values = null;
$optionValues = (object)[
        'values' => (object)[
        'id' => null,
        'label' => null,
        'price' => null,
        'price_type' => null
        ]
];
if( isset($item) ){
$option = $item;

$optionValues = isset($option->{$field->name}) ? $option->{$field->name} : [] ; //here filed->name = values

}
@endphp

<div class="col-12">
    <div class="sortable-header">
        <div class="row">
            <div class="col-md-4 col-xs-12 ">
                <label> @lang("$crud->name::panel.label") </label>
            </div>
            <div class="col-md-4 col-xs-12 ">
                <label> @lang("$crud->name::panel.price") </label>
            </div>
            <div class="col-md-4 col-xs-12 ">
                <label> @lang("$crud->name::panel.price_type") </label>
            </div>
        </div>
    </div>
</div>


<div class="col-12">

    <div class="cloning sortable">


        @foreach ($optionValues as $optionValue)
        <div class="item">
            <div class="row">
                <input type="hidden" name-template="values[xxx][id]" name="values[{{$loop->index}}][id]"
                    value="{{$optionValue->id}}" class="form-control @error($field->name) is-invalid @enderror">
                <div class="col-md-4 col-xs-12 form-group">
                    <input type="text" id="value-label-{{$loop->index}}" id-template="value-label-xxx" required
                        name-template="values[xxx][label]" name="values[{{$loop->index}}][label]"
                        value="{{ $optionValue->label }}" class="form-control @error(" values[{{$loop->index}}][label]")
                        is-invalid @enderror">

                    <span class="invalid-feedback" role="alert">
                        @error("values[{{$loop->index}}][label]")
                        <strong>{{ $message }}</strong>
                        @enderror
                    </span>
                </div>
                <div class="col-md-4 col-xs-12 form-group">
                    <input type="text" id="price-label-{{$loop->index}}" id-template="price-label-xxx" required
                        name-template="values[xxx][price]" name="values[{{$loop->index}}][price]"
                        value="{{ $optionValue->price }}" class="form-control @error(" values[{{$loop->index}}][price]")
                        is-invalid @enderror">

                    <span class="invalid-feedback" role="alert">
                        @error("values[{{$loop->index}}][price]")
                        <strong>{{ $message }}</strong>
                        @enderror
                    </span>
                </div>
                <div class="col-md-4 col-xs-12 form-group">
                    <select name="values[{{$loop->index}}][price_type]" name-template="values[xxx][price_type]"
                        id-template="value-price-type-xxx" required id="value-price-type-{{$loop->index}}"
                        class="form-control select2 @error(" values[{{$loop->index}}][price_type]") is-invalid @enderror">
                        <option value="fixed" @if($optionValue->price_type == 'fixed') selected="selected" @endif
                            >@lang("$crud->name::panel.fixed")</option>
                        <option value="percent" @if($optionValue->price_type == 'percent') selected="selected" @endif
                            >@lang("$crud->name::panel.percent")</option>
                    </select>


                    <span class="invalid-feedback" role="alert">
                        @error("values[{{$loop->index}}][price_type]")
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
    var $cloning,
            $item,
            templateHtml,
            dataId;

        function runCloning(){
            $cloning = $('.cloning');
            $item = $cloning.find('.item');

            $(".cloning").after(`<a class="plus btn"><i class="fas fa-plus"></i></a>`);

            dataId = $item.length - 1;



            $item.each(function(index ){

                templateHtml = $(this).html();

                $(this).remove();
                var newItem = $('<div class="item"></div>');

                $(newItem).append(`<a class="remove-item btn"><i class="fas fa-times"></i></a> ${templateHtml} `);

                $(newItem).find('[name]').each(function(){

                    var nameTemplate = $(this).attr('name-template');
                    $(this).removeAttr('name-template');
                    newName = replaceAll(nameTemplate, 'xxx', dataId);
                    $(this).attr('name', newName );


                });


                $(newItem).find('[id]').each(function(){

                    var idTemplate = $(this).attr('id-template');
                    $(this).removeAttr('id-template');
                    idName = replaceAll(idTemplate, 'xxx', dataId);
                    $(this).attr('id', idName );

                });

                $('.cloning').append(newItem);
                dataId++;
            });
        }


        runCloning();

        function addRow(){

            var newItem = $('<div class="item"></div>');
            $(newItem).append(`<a class="remove-item btn"><i class="fas fa-times"></i></a> ${templateHtml} `);

            $(newItem).find('[name]').each(function(){
                var nameTemplate = $(this).attr('name-template');
                $(this).removeAttr('name-template');
                newName = replaceAll(nameTemplate, 'xxx', dataId);
                $(this).attr('name', newName );
                $(this).val('');
            });



            $(newItem).find('[id]').each(function(){
                var idTemplate = $(this).attr('id-template');
                $(this).removeAttr('id-template');
                idName = replaceAll(idTemplate, 'xxx', dataId);
                $(this).attr('id', idName );
            });





            $('.cloning').append(newItem);
            dataId++;
        }


        $('.cloning').on( "click", 'a.remove-item' ,function (e) {
            e.preventDefault();
            $(this).parents('.item').remove();
        });

        $('body').on( "click", 'a.plus', function () {
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
</script>
@endpush
