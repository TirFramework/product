<style>
    .table-sortable tbody tr {
        cursor: move;
    }

</style>

<div class="container">
    <div class="row clearfix">
        <div class="col-md-12">
            <table class="table table-bordered table-hover table-sortable" id="tab_values">
                <thead>
                <tr >
                    <th class="text-center">
                        @Lang("$crud->name::panel.attribue")
                    </th>
                    <th class="text-center">
                        @Lang("$crud->name::panel.values")
                    </th>

                    <th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
                    </th>
                </tr>
                </thead>
                <tbody>
                @php
                    $values = \Tir\Store\Attribute\Entities\Attribute::select('*')->get()->pluck('name','id');
                @endphp
                <tr id='addr0' data-id="0">
                    <td data-name="att[x-x-x][name]">
                        {!! Form::select("attribtes[0][name]", $values, null,["class"=>"form-control select2"])!!}
                    </td>
                    <td data-name="att[x-x-x][values]">
                        <input type="text" name='att[0][values]'  placeholder='Values' class="form-control"/>
                    </td>
                    <td data-name="del">
                        <button name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'><span aria-hidden="true">×</span></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <a id="add_row" class="btn btn-primary float-right">Add Row</a>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $("#add_row").on("click", function () {
                // Dynamic Rows Code
                var tableId = "#tab_values";
                // Get max row id and set new id
                var newid = 0;
                $.each($(tableId+" tr"), function () {
                    if (parseInt($(this).data("id")) > newid) {
                        newid = parseInt($(this).data("id"));
                    }
                });
                newid++;

                var tr = $("<tr></tr>", {
                    id: "addr" + newid,
                    "data-id": newid
                });

                // loop through each td and create new elements with name of newid
                $.each($(tableId+" tbody tr:nth(0) td"), function () {
                    var td;
                    var cur_td = $(this);

                    var children = cur_td.children();

                    // add new td and element if it has a nane
                    if ($(this).data("name") !== undefined) {
                        td = $("<td></td>", {
                            "data-name": $(cur_td).data("name")
                        });
                        var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                        var newName = $(cur_td).data("name").replace("x-x-x", newid);
                        c.attr("name", newName);
                        c.appendTo($(td));
                        td.appendTo($(tr));
                    } else {
                        td = $("<td></td>", {
                            'text': $(tableId+" tr").length
                        }).appendTo($(tr));
                    }
                });

                // add delete button and td
                /*
                $("<td></td>").append(
                    $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                        .click(function() {
                            $(this).closest("tr").remove();
                        })
                ).appendTo($(tr));
                */

                // add the new row
                $(tr).appendTo($(tableId));

                $(tr).find("td button.row-remove").on("click", function () {
                    $(this).closest("tr").remove();
                });
            });


            // Sortable Code
            var fixHelperModified = function (e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();

                $helper.children().each(function (index) {
                    $(this).width($originals.eq(index).width())
                });

                return $helper;
            };

            $(".table-sortable tbody").sortable({
                helper: fixHelperModified
            }).disableSelection();

            $(".table-sortable thead").disableSelection();


            //$("#add_row").trigger("click");
        });
    </script>
@endpush
