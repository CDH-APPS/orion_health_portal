@extends('main2')

@section('content')



<div class="btn-controls">
    <div class="btn-box-row row-fluid">
        <a href="/CreateNewClaim" class="btn-box big span4"><i class="icon-file"></i><b>Create New Claim</b>
            <br>
            <p class="text-muted">
                Verify members eligibility and create claim session
            </p>
        </a>

        <a href="/PendingSessions" class="btn-box big span4"><i class="icon-tasks"></i><b>Pending Sessions</b>
            <br>
            <p class="text-muted">
                Record investigations, medications and treatments
            </p>
        </a>

        <a href="/PriorAuthorizations" class="btn-box big span4"><i class="icon-user"></i><b>Prior Authorization</b>
            <br>
            <p class="text-muted">
                Request for prior authorization for specialist cases.
            </p>
        </a>                            
    </div>                                                                                      
</div>



@stop