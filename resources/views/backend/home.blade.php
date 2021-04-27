@extends('layouts.backend')

@section('title')
  велком
@endsection

@section('content')

  <?php
  $menu = [
    'сайты' => $sites,
    'категории' => $categories,
    'бренды' => $brands,
    'особенности' => $features,
    'юзеры' => $users,
    'отзывы' => $reviews,
  ];
  ?>

  <table class="table caption-top">

    <caption>статистика</caption>

    <thead class="table-light">
    <tr>
      <th scope="col">сущность</th>
      <th scope="col">колво</th>
    </tr>
    </thead>

    <tbody>

    @foreach($menu as $item => $count)

      <tr>
        <th scope="row">{{$item}}</th>
        <td>{{$count}}</td>
      </tr>

    @endforeach


    </tbody>

  </table>


@endsection
