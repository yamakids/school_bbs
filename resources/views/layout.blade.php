<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>わたし・あなたの学校ってどんなところ？</title>
</head>
<body>
    <header class="navbar navbar-dark bg-dark">
      <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
          <a href="http://127.0.0.1:8000/login" class="text-sm text-gray-700 underline">Login</a>

          <a href="http://127.0.0.1:8000/register" class="ml-4 text-sm text-gray-700 underline">Register</a>
      </div>
      <link
          rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous"
      >
        <div class="container">
            <a class="navbar-brand" href="{{ url('') }}">
              わたし・あなたの学校ってどんなところ？
            </a>
        </div>
    </header>

    <div>
      @yield('content')
    </div>

      @livewireScripts
</body>
</html>
