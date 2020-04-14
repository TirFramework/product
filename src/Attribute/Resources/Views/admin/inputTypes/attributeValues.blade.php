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

<style>
    .ui-sortable .item{
        padding-left: 20px;
        position: relative;
    }
    .item{
        padding-right: 40px;
    }
    .ui-sortable .labels{
        padding-left: 20px;
        position: relative;

    }
    .header{
        padding-right: 40px;
    }
    .remove-item{
        position: absolute;
        right: 0;
        bottom: 1rem;
        cursor: pointer;
    }
    .ui-sortable .item::before{
        content: '';
        width: 20px;
        height: 20px;
        position: absolute;
        left: 0;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-image: url("data:image/svg+xml,%0A%3Csvg height='40' viewBox='-149 0 512 512.10667' width='40' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='m170.71875 256.105469c0 35.347656-28.652344 64-64 64-35.34375 0-64-28.652344-64-64 0-35.34375 28.65625-64 64-64 35.347656 0 64 28.65625 64 64zm0 0'/%3E%3Cpath d='m192.054688 362.773438h-170.667969c-11.753907 0-21.3320315 9.578124-21.3320315 21.332031 0 4.03125 1.0664065 7.832031 3.2851565 11.5625.382812.640625.808594 1.261719 1.277344 1.835937l86.570312 108.03125c4.269531 4.246094 9.773438 6.570313 15.53125 6.570313 5.761719 0 11.265625-2.324219 16.769531-7.914063l85.332031-106.667968c.46875-.574219.898438-1.214844 1.28125-1.832032 2.21875-3.753906 3.285157-7.554687 3.285157-11.585937 0-11.753907-9.578125-21.332031-21.332031-21.332031zm0 0'/%3E%3Cpath d='m21.386719 149.441406h170.667969c11.753906 0 21.332031-9.578125 21.332031-21.335937 0-4.03125-1.066407-7.828125-3.285157-11.5625-.382812-.640625-.8125-1.257813-1.28125-1.832031l-86.570312-108.035157c-8.53125-8.445312-21.289062-9.8125-32.296875 1.367188l-85.335937 106.667969c-.46875.574218-.894532 1.214843-1.277344 1.832031-2.21875 3.734375-3.2851565 7.53125-3.2851565 11.5625 0 11.757812 9.5781245 21.335937 21.3320315 21.335937zm0 0'/%3E%3C/svg%3E");
        bottom: 1.5rem;
        cursor: move;
    }
</style>

<div class="cloning sortable">

        <div class="row labels">
            <div class="col-12">
                <label> name </label>
            </div>
         </div>



    @foreach ($attributeValues as $attributeValue)
        <div class="item">
            <input type="hidden"
                   name-template="values[xxx][id]"
                   name="values[{{$loop->index}}][id]"
                   value="{{$attributeValue->id}}"
                   class="form-control @error($field->name) is-invalid @enderror">
            <div class="row">
                <div class="col-12 form-group">
                    <input type="text"
                           id="values-{{$loop->index}}"
                           name-template="values[xxx][value]"
                           name="values[{{$loop->index}}][value]"
                           value="{{$attributeValue->value}}"
                           class="form-control @error($field->name) is-invalid @enderror">
                </div>
            </div>
        </div>
    @endforeach
</div>



@push('scripts')
    <script>

        var $cloning,
            $item,
            templateHtml,
            dataId;

        function runCloning(){
            $cloning = $('.cloning');
            $item = $cloning.find('.item');

            $(".cloning").after(`<a class="plus btn btn-info">+</a>`);

            dataId = $item.length;

            $item.each(function(index ){

                templateHtml = $(this).html();

                $(this).remove();

                var newHtml = templateHtml.replace("name-template", "name");
                newHtml = newHtml.replace("xxx", index);

                $(".cloning").append(`<div class="item"> <a class="remove-item btn btn-danger">x</a> ${newHtml} </div>`);

                $(this).append(`<a class="remove-item btn btn-danger">x</a>`)

            });
        }


        runCloning();

        function addRow(){

            var newHtml = templateHtml.replace("name-template", "name" );
            newHtml = newHtml.replace("xxx", dataId );

            var newItem = $('<div class="item"></div>');
            $(newItem).append(`<a class="remove-item btn btn-danger">x</a> ${newHtml} `);
            $(newItem).find('[name]').val('');
            $(newItem).find('[name]').first().attr('autofocus','true');
            $('.cloning').append(newItem);
            dataId++;

        }


        $('.cloning').on( "click", 'a.remove-item' ,function (e) {
            e.preventDefault();
            $(this).parents('.item').remove();
        });

        $('body').on( "click", 'a.plus', function () {
            addRow();
        });


        $(function () {
            $(".sortable").sortable();
            $(".sortable").disableSelection();
        });

    </script>
@endpush




