{{--модальное окно--}}

<div id='modal' class="modal" tabindex="-1">

  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">
          {{$header}}
        </h5>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">
        <p>
          {{$body}}
        </p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Close
        </button>
      </div>

    </div>

  </div>

</div>

<script src="{{mix('/js/frontend/global/modal.js')}}"></script>
