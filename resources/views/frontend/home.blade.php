@extends('layouts.frontend')

@section('title')
  главная
@endsection

@section('content')

  {{--вызываем фасад в шаблоне--}}
  {{--  {{myalias::mymethod1()}}--}}
  {{--  {{myalias::mymethod2()}}--}}

  <div class='row justify-content-md-center'>

    <div class='col-8'>

      <div class='row mb-5'>
        <div class='col-4'>
          <svg class="rounded-3" width="100%" height="100%"
               xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="#868e99"></rect>
            <text x="40%" y="50%" fill="#dee2e6">image</text>
          </svg>
        </div>
        <div class='col-8'>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has
          been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
          galley of type and scrambled it to make a type specimen book. It has survived not only five
          centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
          It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
          passages, and more recently with desktop publishing software like Aldus PageMaker including
          versions of Lorem Ipsum.
        </div>
      </div>

      <div class='row mb-5'>
        <div class='col-8'>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has
          been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
          galley of type and scrambled it to make a type specimen book. It has survived not only five
          centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
          It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
          passages, and more recently with desktop publishing software like Aldus PageMaker including
          versions of Lorem Ipsum.
        </div>
        <div class='col-4'>
          <svg class="rounded-3" width="100%" height="100%"
               xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="#868e99"></rect>
            <text x="40%" y="50%" fill="#dee2e6">image</text>
          </svg>
        </div>
      </div>

      <div class='row'>
        <div class='col-4'>
          <svg class="rounded-3" width="100%" height="100%"
               xmlns="http://www.w3.org/2000/svg">
            <rect width="100%" height="100%" fill="#868e99"></rect>
            <text x="40%" y="50%" fill="#dee2e6">image</text>
          </svg>
        </div>
        <div class='col-8'>
          Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
          Ipsum has
          been the industry's standard dummy text ever since the 1500s, when an unknown printer took a
          galley of type and scrambled it to make a type specimen book. It has survived not only five
          centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
          It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
          passages, and more recently with desktop publishing software like Aldus PageMaker including
          versions of Lorem Ipsum.
        </div>
      </div>

    </div>

  </div>

@endsection

@section('pagejs')
  <script src="{{mix('/js/frontend/home.js')}}"></script>
@endsection
