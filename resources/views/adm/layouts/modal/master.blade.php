<div class="modal fade" id="{{ $modal['id'] }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modal['id'] }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{{ $modal['title'] }}</h4>
        </div>
        <div class="modal-body" style="padding-bottom: 0 !important;">
            <p style="font-size: 13px; font-weight: 700;">{!! $modal['body'] !!}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Renunta</button>
            {!! $modal['btn'] !!}
        </div>
      </div>
    </div>
</div>