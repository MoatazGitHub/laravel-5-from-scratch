@extends('layouts.app')

@section('content')



    @if ($errors->any())

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
    @if(session()->has('success'))

        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>

    @endif



 <p>   <a class="btn btn-lg btn-primary"
          href="{{ URL::to('tasks/create' ) }}">New</a></p>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Tasks</h3>
        </div>
        <div class="panel-body">

            @if (count($tasks) > 0)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Mail</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($tasks as $task)
                        <tr>
                            {{--<td>{{$task->body}}</td>--}}
                            {{--<td><a href="">{{$task->is_completed}}</a></td>--}}
                            <td>

                                <form action="tasks/{{$task->id}}" name="complete_task" method="post">
                                    <input type="hidden" value="{{csrf_token()}}" name="_token"/>
                                    <input class="form-check-input defaultCheck1" type="checkbox" value="{{$task->id}}">
                                </form>

                            </td>
                            <td><a href="{{ url('tasks/'.$task->id) }}">{{$task->title}}</a></td>
                            <td><a href="{{ url('tasks/'.$task->id) }}">

                                    @if( $task->is_completed == 0)
                                        InCompleted
                                    @else
                                        Completed
                                    @endif

                                </a></td>


                            <td><a href="{{ url('tasks/'.$task->id) }}">

                                    @if( $task->send_mail == 0)
                                        NO
                                    @else
                                        YES
                                    @endif

                                </a></td>

                            <td>{{$task->toDayDateTimeString($task->created_at)}}</td>
                            <td>
                                <a class="btn btn-small btn-info"
                                   href="{{ URL::to('tasks/' . $task->id . '/edit') }}">Edit</a>

                                {!! Form::open(['method' => 'DELETE','route' => ['tasks.destroy', $task->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>


                        </tr>
                    @endforeach


                    </tbody>
                </table>

                {{--{!! $tasks->links() !!}--}}


            @else
                <p class="text-center">No tasks</p>
            @endif

        </div>
    </div>








@endsection
