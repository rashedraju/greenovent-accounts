<div class="card-body">
    <div class="pb-3">Client Company Name: <br /><strong>{{ $client->company_name }}</strong></div>
    <div class="py-3">Office Address: <br /><strong>{{ $client->office_address }}</strong></div>
    <div class="py-3">Business Manager: <br /><strong>{{ $client->businessManager->name }}</strong></div>
    <div class="py-3">Created At: <br /><strong>{{ $client->created_at }}</strong></div>
</div>
