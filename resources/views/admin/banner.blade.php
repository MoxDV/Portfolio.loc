<div class="xs">
    <h3>Изменение баннера</h3>

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
                'route' => 'admin.banner',
                'class' => 'form-horizontal',
            ]) !!}

            <div class="form-group{{ count($errors->get('fullName')) > 0
                            ? ' has-error' : '' }}">
                <label for="fullName" class="col-sm-2 control-label">
                    Имя Фамилия
                </label>
                <div class="col-sm-8">
                    {!! Form::text('fullName',
                        isset($fullName) ? $fullName : old('fullName') , [
                        'class'         => 'form-control1',
                        'placeholder'   => "Имя Фамилия",
                        'required'      => 'required',
                        'autofocus'     => 'autofocus',
                        'maxlength'     => 191,
                        'minlength'     => 5,
                    ]) !!}
                </div>
                <div class="col-sm-2">
                    <p class="help-block">Иван Иванов</p>
                </div>
            </div>

            <div class="form-group{{ count($errors->get('data')) > 0
                            ? ' has-error' : '' }}">
                <label for="data" class="col-sm-2 control-label">
                    Данные
                </label>
                <div class="col-sm-8">
                    {!! Form::textarea('data',
                        isset($data) ? $data : old('data') , [
                        'class'         => 'form-control1',
                        'required'      => 'required',
                        'minlength'     => 5,
                    ]) !!}
                </div>
                <div class="col-sm-8 col-lg-offset-2">
                    <p class="help-block">
                        I'm a Manila based &lt;span>graphic designer&lt;\span>,
                        &lt;span>illustrator&lt;\span> and
                        &lt;span>webdesigner&lt;\span> creating awesome and
                        effective visual identities for companies of all sizes
                        around the globe. Let's &lt;a class="banner-link link"
                        href="#about\>start scrolling<\/a> and learn more
                        &lt;a class="banner-link link" href="#about">about me&lt;\a>."
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