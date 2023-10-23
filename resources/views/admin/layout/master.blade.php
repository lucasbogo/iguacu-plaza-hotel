<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.ico') }}">

    <title>Painel Administrativo</title>


    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    @include('admin.layout.styles')

    @include('admin.layout.scripts')
</head>

<body>
    <div id="app">
        <div class="main-wrapper">

            @include('admin.layout.header')

            @include('admin.layout.sidebar')

            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('heading')</h1>
                        <div class="section-header-breadcrumb">
                            @yield('right_top_button')
                        </div>
                    </div>

                    @yield('main_content')

                </section>
            </div>

        </div>
    </div>

    @include('admin.layout.scripts_footer')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                iziToast.error({
                    title: 'Erro',
                    message: '{{ $error }}',
                    position: 'topRight'
                });
            </script>
        @endforeach
    @endif

    @if (session()->get('error'))
        <script>
            iziToast.error({
                title: 'Erro',
                message: '{{ session()->get('error') }}',
                position: 'topRight'
            });
        </script>
    @endif

    @if (session()->get('success'))
        <script>
            iziToast.success({
                title: 'Sucesso',
                message: '{{ session()->get('success') }}',
                position: 'topRight'
            });
        </script>
    @endif

</body>

</html>
