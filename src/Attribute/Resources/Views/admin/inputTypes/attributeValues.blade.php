@php
    //generate empty object
    $attributeValues = (object) [
         'values'=> (object)[
                'id'=>null,
                'value' => null
            ]
         ];

    //$attributeValues =  json_decode(json_encode($attributeValues));


    if( isset($item) ){
        $attribute = $item;
        $attributeValues = $attribute->{$field->name};  //here filed->name = values

    }


@endphp


<div class="row sortable-header">
    <div class="col-md-4 col-xs-12 ">
        <label> @lang("$crud->name::panel.name") </label>
    </div>
</div>

<div class="cloning sortable">


    @foreach ($attributeValues as $attributeValue)
        <div class="item">
            <div class="row">
                <input type="hidden" name-template="values[xxx][id]" name="values[{{$loop->index}}][id]"
                       value="{{$attributeValue->id}}" class="form-control @error($field->name) is-invalid @enderror">
                <div class="col-md-12 col-xs-12 form-group">
                    <input type="text" id="values-{{$loop->index}}-value" id-template="values-xxx-value" required
                           name-template="values[xxx][value]" name="values[{{$loop->index}}][value]"
                           value="{{ $attributeValue->value }}" class="form-control @error(" values[{{$loop->index}}][value]")
                            is-invalid @enderror">

                    <span class="invalid-feedback" role="alert">
                    @error("values[{{$loop->index}}][value]")
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




