@php
$langs = [
        ['id'=>'1','name'=>'fa'],
        ['id'=>'2','name'=>'en'],
        ['id'=>'3','name'=>'ar']

        ];

$langs= json_decode(json_encode($langs));

$attributes= $item->getCategoryAttributes($item->id);
$itemAllLangAttributesValues= $item->attributes();

// dd($item->attributes->find()->pivot->where('language_id',1)->get());

@endphp

<div class="card card-default">
    <div class="card-header ">
        <h3>{{$field->display}}</h3>
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
                 @php  $attributesValues = $item->attributes()->wherePivot('language_id', $lang->id)->get(); @endphp
                    <div class="tab-pane fade @if($loop->first) active show @endif" id="attrib-language-{{$lang->id}}">
                        {!! Form::model($item,
                            [
                            'route'=>["$crud->name.updateAttribute",$item->getKey()],
                            'method' => 'put',
                            'class'=>'form-horizontal row',
                            'enctype'=>'multipart/form-data'
                            ]) !!}

                            @foreach ($attributes as $attribute)
                                <div class="{{'col-12 col-md-6'}}">
                                    <div class="form-group">
                                    <input type="text" name="{{ "attributes[$attribute->id][value]" }}" id={{ "attributes-$attribute->id-value" }} class= "form-control"
                                    value = "{{ $attributesValues->find($attribute->id)->pivot->value ?? null}}">

                                    <label for="{{"attributes-$attribute->id-value"}}" class="control-label text-right">
                                        {{$attribute->name}}
                                    </label>

                                    </div>
                                </div>
                                @endforeach

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
