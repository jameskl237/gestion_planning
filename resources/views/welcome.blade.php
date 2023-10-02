@extends('layouts.base')

@section('search_bar')
    <form class="form-inline mr-auto">
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
            <button class="btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
@endsection


@section('content')
    <table class="table table-striped">
        {{-- <th>tchek or not</th> --}}
        <th>Task Name</th>
        <th>Date of creation</th>
        <th>Date of modification</th>
        <th>Action</th>
        </tr>
        @foreach($arr as $tache)

            <tr>
                {{-- <td>
                    <div class="custom-checkbox custom-control">
                    <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                        class="custom-control-input" id="checkbox-all">
                    <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                    </div>
                </td> --}}
                <td><a href="{{ route('info', $tache)}}">{{ $tache->name }}</a></td>

                <td>{{$tache->created_at}}</td>
                <td>{{$tache->updated_at}}</td>

                <td style="display:flex;">
                    <a class="btn btn-primary btn-action mr-1 mt-2 mb-4" href="{{route('edit',$tache)}}" title="Edit">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <form action="{{ route('destroy', $tache->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-action mt-2" data-toggle="tooltip" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce todo ?')" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" title="Delete"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
