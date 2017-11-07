<div class="xs">
    <h3>Редактирование контактов автора</h3>

    @if(count($errors) > 0)
        <div class="alert alert-dismissible alert-danger">
            <strong>Ошибка!</strong>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-dismissible alert-success">
            <strong>Браво!</strong>
            {!! Session::get('success') !!}
        </div>
    @endif

    <div class="tab-content">
        <div class="tab-pane active">
            {!! Form::open([
                'route' => 'admin.contacts',
                'class' => 'form-horizontal',
                'method'=> 'post',
            ]) !!}

            <div class="form-group{{ count($errors->get('address')) > 0
                        ? ' has-error' : '' }}">
                <label for="address" class="col-sm-2 control-label">
                    Адресс автора
                </label>
                <div class="col-sm-8">
                    {!! Form::textarea('address',
                        old('address') ?: $address, [
                        'class'         => 'form-control1',
                        'placeholder'   => "Данные о авторе",
                        'required'      => 'required',
                        'autofocus'     => 'autofocus',
                        'minlength'     => 10,
                    ]) !!}
                </div>
                <div class="col-sm-2">
                    <p class="help-block">
                        Область<br>Город и т.д.<br>Телефон
                    </p>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-8 col-lg-offset-2">
                    {{ Form::submit('Изменить',
                        ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>