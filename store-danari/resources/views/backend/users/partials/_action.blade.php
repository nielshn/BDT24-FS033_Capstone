<div class="flex space-x-2">
    <a href="#" class="px-2 py-1 bg-blue-500 text-white rounded-md">
        Edit
    </a>
    <form action="#" method="POST"
        onsubmit="return confirm('Are you sure?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded-md">Delete</button>
    </form>
</div>
