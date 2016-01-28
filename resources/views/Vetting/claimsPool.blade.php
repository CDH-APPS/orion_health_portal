@extends('Vetting.main')

@section('content')



                        <div class="module">
                            <div class="module-head">
                                <h3>CLAIMS POOL</h3>
                            </div>
                            <div class="module-body table">
                                <table id="tblClaims" cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display">
                                    <thead>
                                        <tr class="headings">
                                            <th>CLAIM NO</th>
                                            <th>SERVICE PROVIDER</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>



<script type="text/javascript">
    

    $(document).ready(function(){

       loadClaims();
       $('#tblClaims').DataTable();

    });



    function addtopool(claim_id)
    {
        
        if(confirm("The selected claim "+ claim_id +" would be added to your pending list. Please click OK to continue."))
        {
            //Load Users
            $.get('/AddClaimToPending',
            {
               "CLAIM_ID": claim_id                      
            },
            function(data)
            {              
                   if(data['OK']){ alert('Claim has been added to your pending claims.'); loadClaims(); }

                                
            },'json');

            $('#tblClaims').DataTable();
        }

        
    }

    function loadClaims()
    {
        
            //Load Users
            $.get('/LoadClaimsPool',
            {
                             
            },
            function(data)
            { 

                  $('#tblClaims tbody').empty();
                  $.each(data, function (key, value) 
                  {
                    $('#tblClaims tbody').append('<tr><td>'+ value['Claim_ID'] +'</td><td>'+ value['Service_Provider'] +'</td><td><a onclick="addtopool(\''+value['Claim_ID']+'\')" class="btn btn-success pull-right">Add to Pending</a></td></tr>');
                
                    $('#tblClaims').DataTable();
                });
                
                                            
            },'json');

            
        

        
    }

</script>


@stop
