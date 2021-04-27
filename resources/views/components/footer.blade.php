<footer class="pt-4 my-md-5 pt-md-5 border-top">
  <div class="row">

    <div class="col-12 col-md">
      <small class="d-block mb-3 text-muted">Reviewli ©2021</small>
    </div>

    <!------------------------------------------------->

    @if ($categories->isNotEmpty())
      <div class="col-6 col-md">
        <h5>категории</h5>
        <ul class="list-unstyled text-small">
          @foreach ($categories as $category)
            <li><a class="link-secondary" href="#">{{ $category->name }}</a></li>
          @endforeach
        </ul>
      </div>
    @endif

  <!------------------------------------------------->

    @if ($brands->isNotEmpty())
      <div class="col-6 col-md">
        <h5>бренды</h5>
        <ul class="list-unstyled text-small">
          @foreach ($brands as $brand)
            <li><a class="link-secondary" href="#">{{ $brand->name }}</a></li>
          @endforeach
        </ul>
      </div>
    @endif

  <!------------------------------------------------->

    @if ($features->isNotEmpty())
      <div class="col-6 col-md">
        <h5>особенности</h5>
        <ul class="list-unstyled text-small">
          @foreach ($features as $feature)
            <li><a class="link-secondary" href="#">{{ $feature->name }}</a></li>
          @endforeach
        </ul>
      </div>
  @endif

  <!------------------------------------------------->

  </div>
</footer>

<footer class="my-5 pt-5 text-muted text-center text-small">
  <ul class="list-inline">
    <li class="list-inline-item"><a href="#">форум</a></li>
    <li class="list-inline-item"><a href="#">магазин</a></li>
    <li class="list-inline-item"><a href="#">контакты</a></li>
  </ul>
</footer>
