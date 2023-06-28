@include('nav')


<h1>Painel Usuário</h1>
<p>Hi {{ Auth::guard('web')->user()->name }}, Bem-vindo ao seu espaço pessoal no site Iguaçu Plaza Hotel.</p>