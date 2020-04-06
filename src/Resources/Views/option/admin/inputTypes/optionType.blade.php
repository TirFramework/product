@php
$langs = [
        ['id'=>'1','name'=>'fa'],
        ['id'=>'2','name'=>'en'],
        ['id'=>'3','name'=>'ar']

        ];

$langs= json_decode(json_encode($langs));


@endphp

<div class="card card-default">
    <div class="card-header ">
        <h3>@lang("$crud->name::panel.$field->display")</h3>
    </div>
    <div class="card-body">
                <ul class="nav nav-tabs mb-4">
                    @foreach ($langs as $lang)
                    <li class="nav-item">
                        <a href="#attrib-language-{{$lang->id}}" class="nav-link @if($loop->first)  active @endif "
                            data-toggle="tab">{{$lang->name}}</a>
                    </li>
                    @endforeach
                </ul>

        <div class="tab-content">
            @foreach ($langs as $lang)
                    <div class="tab-pane fade @if($loop->first) active show @endif" id="attrib-language-{{$lang->id}}">
                        {!! Form::model($item,
                            [
                            'route'=>["$crud->name.updateOptionValue",$item->getKey()],
                            'method' => 'put',
                            'class'=>'form-horizontal row',
                            'enctype'=>'multipart/form-data'
                            ]) !!}

                            <p class="col-12">

                                <input type="hidden" name="option_value[1][id]" id="option_1_id" class= "form-control"
                                value = "{{ null ?? null}}">

                                <div class="{{'col-12 col-md-4'}}">
                                    <div class="form-group">

                                        <input type="text" name="option_value[1][value]" id="option_1_value" class= "form-control"
                                        value = "{{ null ?? null}}">
    
                                        <label for="option_1_value" class="control-label text-right">
                                            @lang("store::panel.option")
                                        </label>
                                    </div>
                                </div>
    
                                <div class="{{'col-12 col-md-4'}}">
                                    <div class="form-group">
                                        <input type="text" name="option_value[1][image]" id="option_value_image" class= "form-control"
                                        value = "{{ null ?? null}}">
    
                                        <label for="option_value_image" class="control-label text-right">
                                            @lang("store::panel.option")
                                        </label>
                                    </div>
                                </div>
    
                                <div class="{{'col-12 col-md-2'}}">
                                    <div class="form-group">

                                        <input type="text" name="option_value[1][sort_order]" id="option_value_sort_order" class= "form-control"
                                        value = "{{ null ?? null}}">
    
                                        <label for="option_value_sort_order" class="control-label text-right">
                                            @lang("store::panel.option")
                                        </label>
                                    </div>
                                </div>

                            </p>
                            <p class="col-12">

                                <input type="hidden" name="option_value[2][id]" id="option_2_id" class= "form-control"
                                value = "{{ null ?? null}}">

                                <div class="{{'col-12 col-md-4'}}">
                                    <div class="form-group">
                                           
                                        <input type="text" name="option_value[2][value]" id="option_1_value" class= "form-control"
                                        value = "{{ null ?? null}}">
    
                                        <label for="option_1_value" class="control-label text-right">
                                            @lang("store::panel.option")
                                        </label>
                                    </div>
                                </div>
    
                                <div class="{{'col-12 col-md-4'}}">
                                    <div class="form-group">
                                        <input type="text" name="option_value[2][image]" id="option_value_image" class= "form-control"
                                        value = "{{ null ?? null}}">
    
                                        <label for="option_value_image" class="control-label text-right">
                                            @lang("store::panel.option")
                                        </label>
                                    </div>
                                </div>
    
                                <div class="{{'col-12 col-md-2'}}">
                                    <div class="form-group">
                                        <input type="text" name="option_value[2][sort_order]" id="option_value_sort_order" class= "form-control"
                                        value = "{{ null ?? null}}">
    
                                        <label for="option_value_sort_order" class="control-label text-right">
                                            @lang("store::panel.option")
                                        </label>
                                    </div>
                                </div>

                            </p>



                        {!! Form::hidden('language_id', $lang->id) !!}

                        <div class="col-12">
                            <div class="form-group text-right">
                                {!! Form::label('', '', ['class' => ' control-label']) !!}
                                <div class="">
                                    {!! Form::submit(trans('crud::panel.update'),['class'=>'btn btn-md btn-info save'])!!}
                                </div>
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
            @endforeach
        </div>

    </div>
</div>
