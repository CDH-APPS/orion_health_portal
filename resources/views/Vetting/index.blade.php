@extends('Vetting.main')

@section('content')



<div class="btn-controls">
    <div class="btn-box-row row-fluid">
        <a href="/ClaimsPool" class="btn-box big span4"><i class=" icon-file"></i><b>Claims Pool</b>
            <br>
            <p class="text-muted">
                9 Claims
            </p>
        </a>

        <a href="/PendingClaims" class="btn-box big span4"><i class="icon-tasks"></i><b>Pending Claims</b>
            <br>
            <p class="text-muted">
                34 Claims
            </p>
        </a>

        <a href="/PriorAuthorization" class="btn-box big span4"><i class="icon-user"></i><b>Prior Authorization</b>
            <br>
            <p class="text-muted">
               0 Requests
            </p>
        </a>                            
    </div>                                                                                      
</div>



@stop