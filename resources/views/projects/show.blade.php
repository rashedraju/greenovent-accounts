<x-app-layout>
    <div class="flex-lg-row-fluid ms-lg-15">
        <x-project.navigation :project="$project" active="overview" />
        <x-project.overview :project="$project" />
    </div>
</x-app-layout>
