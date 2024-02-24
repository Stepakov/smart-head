@if( session( 'notification' ) )
    <div class="alert alert-success">
        <div class="container">
            {{ session( 'notification' ) }}
        </div>
    </div>
@endif
