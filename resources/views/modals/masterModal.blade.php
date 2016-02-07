<div id="@yield('modalID')" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@yield('modalHeader')</h4>
            </div>
            <div class="modal-body">
                @yield('modalBody')
            </div>
            <div class="modal-footer">
                @yield('modalFooter')
            </div>
        </div>
    </div>
</div>
