<x-app-layout>

    <x-project.aside :project="$project" />
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="overview" />
        <x-project.costs :project="$project" />
    </div>
</x-app-layout>
