<div class="xs">
    <h3>{{ $title }}</h3>

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
                'route' => $route,
                'class' => 'form-horizontal',
                'files' => true,
                'method'=> $method,
            ]) !!}

            <div class="form-group{{ count($errors->get('title')) > 0
                        ? ' has-error' : '' }}">
                <label for="title" class="col-sm-2 control-label">
                    Заголовок
                </label>
                <div class="col-sm-8">
                    {!! Form::text('title',
                        isset($social->title) ? $social->title : old('title') , [
                        'class'         => 'form-control1',
                        'placeholder'   => "Заголовок",
                        'required'      => 'required',
                        'autofocus'     => 'autofocus',
                        'maxlength'     => 191,
                        'minlength'     => 2,
                    ]) !!}
                </div>
                <div class="col-sm-2">
                    <p class="help-block">Facebook</p>
                </div>
            </div>

            <div class="form-group{{ count($errors->get('path')) > 0
                        ? ' has-error' : '' }}">
                <label for="path" class="col-sm-2 control-label">
                    Url-адрес
                </label>
                <div class="col-sm-8">
                    {!! Form::text('path',
                        isset($social->path) ? $social->path : old('path') , [
                        'class' => 'form-control1',
                        'placeholder' => "URL",
                        'required'      => 'required',
                        'maxlength'     => 191,
                        'minlength'     => 5,
                    ]) !!}
                </div>
                <div class="col-sm-2">
                    <p class="help-block">https://ru-ru.facebook.com/</p>
                </div>
            </div>

            <div class="form-group{{ count($errors->get('icon')) > 0
                        ? ' has-error' : '' }}">
                <label for="icon" class="col-sm-2 control-label">
                    Иконка
                </label>
                <div class="col-sm-8">
                    @if(isset($social->icon))
                        <span class="help-block">
                                Текущая иконка:
                                <i class="fa {{ $social->icon }}" style="width: 50px"></i>
                            </span>
                    @endif
                    {!! Form::text('icon',
                        isset($social->icon) ? $social->icon : old('icon') , [
                        'class' => 'form-control1',
                        'placeholder' => "Иконка",
                        'required'      => 'required',
                        'maxlength'     => 191,
                        'minlength'     => 5,
                    ]) !!}
                </div>
                <div class="col-sm-2">
                    <p class="help-block">
                        fa-facebook<br />
                        <a href="http://fontawesome.io/icons/">
                            Иконки
                        </a>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-8 col-lg-offset-2">
                    {{ Form::submit($button_txt,
                        ['class' => 'btn btn-primary']) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>