@extends('masterPage')

@section('body')
    <?php
    $x = 1;
    ?>

    <div class="container">
        <div class="jumbotron">
            <h3>{{$filename}}<br />Version History</h3>
        </div>
        @foreach($audit as $file)
            <h4>Version {{$x++}}</h4> <br>
            <table>
                <tr>
                    <td>Editor: </td>
                    <td>{{$file->user}}</td></tr>
                <tr>
                    <td>Timestamp: </td>
                    <td>{{date('h:i:s A F d, Y', strtotime($file->stamp->date))}}</td></tr>
                <tr><td colspan="2">Remarks:</td></tr>
                <tr><td colspan="2">{{$file->note}}</td></tr>
            </table>
            <br />
            <hr>
            <br />

        @endforeach
    </div>

@endsection