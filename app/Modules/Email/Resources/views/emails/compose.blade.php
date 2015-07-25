@extends('email::layouts.compose')

@section('content')
    <table class="twelve columns">
        <tr>
            <td>
                {!! $data->html !!}
            </td>
        </tr>
    </table>
@stop