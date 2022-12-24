<x-guest-layout>
    <div class="bg-gray mt-1 py-6">
        <div class="container">
            <h1 class="heading-tertiory text-center mb-10 md:mb-16">{{ $title }}</h1>
            <div class="max-w-7xl w-full inline-flex single-feature gap-10 flex-wrap mx-auto mb-4">
                @foreach ($courses as $course)
                    @include('components.course-box', ['course' => $course])
                @endforeach
            </div>
            {{ $courses->links() }}
        </div>
    </div>
</x-guest-layout>
