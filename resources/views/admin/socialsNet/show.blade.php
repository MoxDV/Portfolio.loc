<div class="xs">
    <h3>{{ $title }}</h3>
    <div class="tab-content">
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                <strong>Браво!</strong>
                {!! Session::get('success') !!}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-dismissible alert-danger">
                <strong>Ошибка!</strong>
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if($socials->count() > 0)
            <table class="table  table-striped">
                <thead>
                <tr class="warning">
                    <th>Название</th>
                    <th>Изображение</th>
                    <th>Путь</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($socials as $social)
                    @include('admin.socialsNet.item',
                        ['class' => null, 'social' => $social, 'method' => $method])
                @endforeach
                </tbody>
            </table>
        @else
            <h4>Социальных сетей нет!</h4>
        @endif
    </div>
</div>