<div class="flex space-x-2">
    {{-- <a href="#" onclick="showFAQDetailModal('{{ $category->name }}', '{{ $category->slug }}')"
        class="px-4 py-2 bg-green-400 text-white rounded-md flex items-center justify-center">
        <!-- Icon mata SVG berwarna hijau -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5z" />
        </svg> --}}
    </a>

    <a href="{{ route('admin.categories.edit', $category) }}"
        class="flex items-center px-2 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.232 5.232a3 3 0 011.768.768l2.83 2.83a3 3 0 010 4.243l-7.182 7.182a4 4 0 01-1.414.707L9 21l-.293-1.414a4 4 0 01.707-1.414l7.182-7.182a3 3 0 010-4.243l2.83-2.83a3 3 0 01.768-1.768zM12.707 8.707l1.586-1.586m-7.418 9.192l.293 1.414a4 4 0 001.414-.707l7.182-7.182a3 3 0 00-4.243-4.243l-7.182 7.182a4 4 0 00-.707 1.414l1.414.293z" />
        </svg>
        <span class="ml-1">Edit</span>
    </a>

    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="delete-form d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" id="delete-btn"
            class="flex items-center justify-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21.0697 5.23C19.4597 5.07 17.8497 4.95 16.2297 4.86V4.85L16.0097 3.55C15.8597 2.63 15.6397 1.25 13.2997 1.25H10.6797C8.34967 1.25 8.12967 2.57 7.96967 3.54L7.75967 4.82C6.82967 4.88 5.89967 4.94 4.96967 5.03L2.92967 5.23C2.50967 5.27 2.20967 5.64 2.24967 6.05C2.28967 6.46 2.64967 6.76 3.06967 6.72L5.10967 6.52C10.3497 6 15.6297 6.2 20.9297 6.73C20.9597 6.73 20.9797 6.73 21.0097 6.73C21.3897 6.73 21.7197 6.44 21.7597 6.05C21.7897 5.64 21.4897 5.27 21.0697 5.23Z"
                    fill="white" />
                <path
                    d="M19.2297 8.14C18.9897 7.89 18.6597 7.75 18.3197 7.75H5.67975C5.33975 7.75 4.99975 7.89 4.76975 8.14C4.53975 8.39 4.40975 8.73 4.42975 9.08L5.04975 19.34C5.15975 20.86 5.29975 22.76 8.78975 22.76H15.2097C18.6997 22.76 18.8397 20.87 18.9497 19.34L19.5697 9.09C19.5897 8.73 19.4597 8.39 19.2297 8.14ZM13.6597 17.75H10.3297C9.91975 17.75 9.57975 17.41 9.57975 17C9.57975 16.59 9.91975 16.25 10.3297 16.25H13.6597C14.0697 16.25 14.4097 16.59 14.4097 17C14.4097 17.41 14.0697 17.75 13.6597 17.75ZM14.4997 13.75H9.49975C9.08975 13.75 8.74975 13.41 8.74975 13C8.74975 12.59 9.08975 12.25 9.49975 12.25H14.4997C14.9097 12.25 15.2497 12.59 15.2497 13C15.2497 13.41 14.9097 13.75 14.4997 13.75Z"
                    fill="white" />
            </svg>
            <span class="ml-1">Delete</span>
        </button>
    </form>
</div>
