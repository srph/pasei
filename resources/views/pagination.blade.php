@if ($paginator->hasPages())
  <div class="u-clearfix">
    <a href="{{ $paginator->previousPageUrl() }}" class="btn btn--outlined u-pull-left @if($paginator->onFirstPage()) btn--disabled @endif">
      Previous
    </a>

    <a href="{{ $paginator->nextPageUrl() }}" class="btn btn--outlined u-pull-right @if(!$paginator->hasMorePages()) btn--disabled @endif">
      Next
    </a>
  </div>
@endif