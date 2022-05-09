<div class="card-body">
    <div class="pb-3">Project Name: <br /><strong>{{ $project->name }}</strong></div>
    <div class="pb-3">Project Type: <br /><strong>{{ $project->type->name }}</strong></div>
    <div class="pb-3">Client Company Name: <br /><strong>{{ $project->client->company_name }}</strong></div>
    <div class="py-3">Business Manager: <br /><strong>{{ $project->businessManager->name }}</strong></div>
    <div class="py-3">PO Number: <br /><strong>{{ $project->po_number }}</strong></div>
    <div class="py-3">PO Value: <br /><strong>{{ $project->po_value }}</strong></div>
    <div class="py-3">Bill Type: <br /><strong>{{ $project->billType->name }}</strong></div>
    <div class="py-3">Start Date: <br /><strong>{{ $project->start_date }}</strong></div>
    <div class="py-3">Closing Date: <br /><strong>{{ $project->closing_date }}</strong></div>
    <div class="py-3">Status: <br /><strong>{{ $project->status->name }}</strong></div>
    <div class="py-3">Created At: <br /><strong>{{ $project->created_at }}</strong></div>
</div>
