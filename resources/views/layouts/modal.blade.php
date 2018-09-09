<div class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        @if(isset($form_action))
            <form class="form-horizontal" method="post" action="{{ $form_action }}">
                {!! csrf_field() !!}
                @if(isset($form_method) && $form_method == 'put')
                    <input name="_method" type="hidden" value="PUT">
                @elseif(isset($form_method) && $form_method == 'delete')
                    <input name="_method" type="hidden" value="DELETE">
                @endif
        @endif
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    @yield('form_header')
                </div>
                <div class="modal-body">
                    @yield('form_body')
                </div>
                <div class="modal-footer">
                    @yield('form_footer')
                </div>
            </div>
        @if(isset($form_action))
            </form>
        @endif
    </div>
</div>