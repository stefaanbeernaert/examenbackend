<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>examen backend</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>

<main>
    @yield('content')
    <section id="addtask" class="container mt-5">
        @if(Session::has('task'))
            <div class="col-12 alert alert-secondary alert-dismissible fade show" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                    <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                </svg> {{session('task')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            <div class="row shadow-lg">
                        <form action="{{route('home.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-12 d-flex justify-content-center my-5 ">
                                <div class="form-group">
                                    <input type="text" name="task" id="task" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class=" mx-2  btn btn-light shadow-sm ">Add task</button>
                                </div>
                            </div>


                        </form>



            </div>

    </section>
    <section id="showtask" class="container">

            <div class="row shadow-lg">
                <div class="col-12 d-flex justify-content-center ">
                    <ul class="list-group list-unstyled  ">
                        @foreach($tasks as $task)
                        <div class="d-flex">
                            <li class=" mx-2 my-3 fs-5 ">{{$task->task}}</li>
                            <li class="mx-2 fs-5 my-3 fw-bold ">{{$task->user->name}}</li>
                            <form action="{{route('home.destroy',$task)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <li class=" mx-2  my-3 shadow-sm">  <button type="submit" class="mx-2 btn btn-sm ">x</button></li>
                            </form>

                        </div>


                        @endforeach
                    </ul>
                </div>
            </div>

    </section>
</main>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
